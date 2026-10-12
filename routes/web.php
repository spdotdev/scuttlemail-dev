<?php

use Illuminate\Support\Facades\Route;
use Spdotdev\ScuttlemailDev\Http\Controllers\SiteController;

Route::domain(config('scuttlemail-dev.domain'))
    ->middleware('web')
    ->group(function () {
        Route::get('/', [SiteController::class, 'index'])->name('scuttlemail.home');

        // Crawler files served at the site root.
        Route::get('/robots.txt', [SiteController::class, 'robots'])->name('scuttlemail.robots');
        Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('scuttlemail.sitemap');
    });
