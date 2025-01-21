<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return redirect('api/documentation');
});

Route::get('/test-log', function () {
    Log::info('Test log entry');
    return 'Log entry added';
});
