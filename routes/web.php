<?php

use App\Http\Actions\Link\Details;
use App\Http\Actions\Link\Open as OpenLinkAction;
use App\Http\Actions\Link\Shorten;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'index'])->name('index');

Route::group(['as' => 'link.'], function() {
    Route::post('process', [Shorten::class, 'execute'])->name('process');
    Route::get('stats/{id}', [Details::class, 'execute'])->name('details');
    Route::get('s/{code}', [OpenLinkAction::class, 'execute'])->name('open');
});
