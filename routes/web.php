<?php

use Illuminate\Http\Request;
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

// www is not used: send it, with the path and query, to the bare domain.
Route::domain('www.'.config('scuttlemail-dev.domain'))
    ->middleware('web')
    ->group(function () {
        Route::get('/{path?}', function (Request $request, ?string $path = null) {
            $target = 'https://'.config('scuttlemail-dev.domain').'/'.ltrim((string) $path, '/');
            $query = $request->getQueryString();

            return redirect()->away($query === null ? $target : $target.'?'.$query, 301);
        })->where('path', '.*')->name('scuttlemail.www-redirect');
    });
