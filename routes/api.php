<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return response()->json(["message" => "Hello World!"], 200);
});

Route::get("/students", function () {
    return response()->json(["message" => "Getting Students List..."], 200);
});
