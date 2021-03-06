<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRatingController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::apiResource("categories", CategoryController::class);
Route::apiResource("products", ProductController::class)->middleware(
    "auth:sanctum"
);
Route::post("products/{product}/rate", [
    ProductRatingController::class,
    "rate",
])->middleware("auth:sanctum");
Route::post("products/{product}/unrate", [
    ProductRatingController::class,
    "unrate",
])->middleware("auth:sanctum");

Route::post("sanctum/token", LoginController::class);
Route::post("/notification", [NotificationController::class, "send"]);

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});
