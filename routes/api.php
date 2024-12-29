<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/students", function () {
    return response()->json(["message" => "Getting Students List..."], 200);
});

Route::get("/student/{id}", function () {
    return response()->json(["message" => "Getting Student"], 200);
});

Route::post("/students", function () {
    return response()->json(["message" => "Creating the student"], 200);
});

Route::put("/student/{id}", function () {
    return response()->json(["message" => "Updating student"], 200);
});

Route::patch("/student/{id}/property/{name}", function () {
    return response()->json(["message" => "changing attribute of student {id}"], 200);
});

Route::delete("/student/{id}", function () {
    return response()->json(["message" => "Deleting student..."], 200);
});
