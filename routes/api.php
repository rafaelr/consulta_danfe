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

Route::post('/nfe/{chaveNfe}/json', [CDanfe::class, 'getDanfeJson'])
    ->name('nfe.download.default')
    ->where('chaveNfe', '[0-9]{44}'); // Assuming the NFe key is 44 digits long
    