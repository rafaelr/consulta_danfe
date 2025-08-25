<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NFePHP\DA\NFe\Danfe as Danfe;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use SimpleXMLElement;

class CDanfe extends Controller
{


      public function getDanfe($chaveNfe)
    {
        $credentials = env('SERPRO_CLIENT_ID') . ':' . env('SERPRO_CLIENT_SECRET');
        $encodedCredentials = base64_encode($credentials);
        $token = $this->getAccessToken(env('SERPRO_URL') . '/token', $encodedCredentials);

        $url = env('SERPRO_URL') . '/consulta-nfe-df/api/v1/nfe/' . $chaveNfe;
        $headers = [
            "Authorization: Bearer " . $token,
            "Accept: application/json",
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception("Erro na consulta: " . $error);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new \Exception("Erro na consulta: HTTP " . $httpCode . ", Detalhes: " . $response);
        }

        return $response;

    }

    public function getDanfeJson($chaveNfe)
    {
        $notaFiscalJson = $this->getDanfe($chaveNfe);
        $notaFiscal = json_decode($notaFiscalJson, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Erro ao decodificar JSON: " . json_last_error_msg());
        }

        return response()->json($notaFiscal);

    }

    public function getAccessToken($tokenUrl, $encodedCredentials)
    {
        if (session()->has('access_token') && session()->has('token_expiration')) {
            $expiration = session('token_expiration');
            if (Carbon::now()->lessThan($expiration)) {
                return session('access_token');
            }
        }

        $headers = [
            "Authorization: Basic " . $encodedCredentials,
            "Content-Type: application/x-www-form-urlencoded",
        ];
        $data = http_build_query(['grant_type' => 'client_credentials']);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception("Erro na obtenção do token: " . $error);
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new \Exception("Erro na obtenção do token: HTTP " . $httpCode . ", Detalhes: " . $response);
        }

        $jsonResponse = json_decode($response, true);
        $accessToken = $jsonResponse['access_token'] ?? null;

        if ($accessToken) {
            $expiration = Carbon::now()->addHours(7);
            session(['access_token' => $accessToken, 'token_expiration' => $expiration]);
        }

        return $accessToken;
    }

    public function downloadPdf($chaveNfe)
    {
        
        $notaFiscal = $this->getDanfe($chaveNfe);
    
        $xml = $this->jsonToXml($notaFiscal);
        $xmlFileName = "nota_fiscal_.xml";
        $xmlPath = storage_path("app/public/" . $xmlFileName);
        Storage::disk("public")->put($xmlFileName, $xml);

        try {
            $xmlContent = file_get_contents($xmlPath);
            if (
                strpos($xmlContent, "<NFe") === false &&
                strpos($xmlContent, "<nfeProc") === false
            ) {
                throw new \Exception(
                    "O XML gerado não possui o formato esperado de uma NFe."
                );
            }

            $danfe = new Danfe($xmlContent, "P", "A4", "I");
            $danfe->creditsIntegratorFooter("Feito por RazTec", true);
            $pdfFileName = "nota_fiscal_.pdf";
            $pdfPath = storage_path("app/public/" . $pdfFileName);

            $pdf = $danfe->render();
            file_put_contents($pdfPath, $pdf);
            Storage::disk("public")->put($pdfFileName, $pdf);
            unlink($xmlPath);
            if (!file_exists($pdfPath)) {
                return back()->with(
                    "error",
                    "Erro ao gerar PDF: Arquivo não encontrado."
                );
            }

            return response()
                ->file($pdfPath, [
                    "Content-Type" => "application/pdf",
                    "Content-Disposition" =>
                    'inline; filename="' . $pdfFileName . '"',
                ])
                ->deleteFileAfterSend(true);

            unlink($pdfPath);
        } catch (\Exception $e) {
            return back()->with(
                "error",
                "Erro ao gerar PDF: " . $e->getMessage()
            );
        }
    }

    public function downloadXml($chaveNfe)
    {
        $notaFiscal = $this->getDanfe($chaveNfe);

        $xml = $this->jsonToXml($notaFiscal);

        $xmlFileName = "nota_fiscal_" . $chaveNfe . ".xml";
        Storage::disk("public")->put($xmlFileName, $xml);

        return response()
            ->download(storage_path("app/public/" . $xmlFileName), $xmlFileName, [
            "Content-Type" => "application/xml",
            ])
            ->deleteFileAfterSend(true);
    }

    private function jsonToXml($json)
    {
        $data = is_array($json) ? $json : json_decode($json, true);

        if (empty($data) || !is_array($data)) {
            throw new \Exception(
                "Invalid or empty JSON data for XML conversion."
            );
        }

        $xml = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8"?><nfeProc></nfeProc>'
        );

        $this->arrayToXml($data, $xml);
        $xml->addAttribute("versao", "4.00");
        $xml->addAttribute("xmlns", "http://www.portalfiscal.inf.br/nfe");

        if (isset($data["nfeProc"]["NFe"]["infNFe"]["Id"])) {
            $xml->nfeProc->NFe->infNFe->addAttribute(
                "Id",
                "NFe" . $data["nfeProc"]["NFe"]["infNFe"]["Id"]
            );
        }

        return $xml->asXML();
    }

    private function arrayToXml($data, \SimpleXMLElement &$xml)
    {
        foreach ($data as $key => $value) {
            if ($key === 'det') {
                continue;
            }

            if (is_array($value)) {
                if (is_numeric($key)) {
                    $key = 'item';
                }
                $subnode = $xml->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                if (!empty($key) && !is_numeric($key)) {
                    $xml->addChild($key, htmlspecialchars((string) $value));
                }
            }
        }
        if (isset($data['det']) && is_array($data['det'])) {
            foreach ($data['det'] as $detItem) {
                $detNode = $xml->addChild('det');
                $this->arrayToXml($detItem, $detNode);
            }
        }
    }

    
}
