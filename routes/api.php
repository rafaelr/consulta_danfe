<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CDanfe;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/nfe/{chaveNfe}/pdf', [CDanfe::class, 'downloadPdf'])
    ->name('nfe.download.pdf')
    ->where('chaveNfe', '[0-9]{44}'); // Assuming the NFe key is 44 digits long

Route::get('/nfe/{chaveNfe}/xml', [CDanfe::class, 'downloadXml'])
    ->name('nfe.download.xml')
    ->where('chaveNfe', '[0-9]{44}'); // Assuming the NFe key is 44 digits long

Route::get('/nfe/{chaveNfe}/{format?}', function ($chaveNfe, $format = null) {
    if ($format === 'json') {
        return response()->json(['message' => 'JSON format requested', 'chaveNfe' => $chaveNfe]);
    }
    return response()->json(['message' => 'Default JSON response', 'chaveNfe' => $chaveNfe]);
})->where('chaveNfe', '[0-9]{44}')
  ->name('nfe.download.default');
