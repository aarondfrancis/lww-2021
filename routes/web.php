<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $results = \App\Sidecar\Random::execute();

    dd($results->rawAwsResult());

    return 'done';
});


