<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CDanfe;

Route::middleware(['auth:sanctum'])->post('/user', function (Request $request) {
    return $request->user();
});

Route::post('/nfe/{chaveNfe}/pdf', [CDanfe::class, 'downloadPdf'])
    ->name('nfe.download.pdf')
    ->where('chaveNfe', '[0-9]{44}'); // Assuming the NFe key is 44 digits long

Route::post('/nfe/{chaveNfe}/xml', [CDanfe::class, 'downloadXml'])
    ->name('nfe.download.xml')
    ->where('chaveNfe', '[0-9]{44}'); // Assuming the NFe key is 44 digits long

Route::any('/nfe/{chaveNfe}/{format?}', function (Request $request, $chaveNfe, $format = null) {
    if ($request->isMethod('get')) {
        return response()->json(['error' => 'The GET method is not supported for this route'], 405);
    }
    if ($format === 'json') {
        return response()->json(['message' => 'JSON format requested', 'chaveNfe' => $chaveNfe]);
    }
    return response()->json(['message' => 'Default JSON response', 'chaveNfe' => $chaveNfe]);
})->where('chaveNfe', '[0-9]{44}')
  ->name('nfe.download.default');
