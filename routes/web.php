<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [PageController::class, "showHome"])->name("home");
Route::get("/contact", [PageController::class, "showContact"])->name("contact.show");
Route::post("/contact", [PageController::class, "sendMail"])->name("contact.send");

Route::middleware(["auth:sanctum", config("jetstream.auth_session"), "verified"])->group(function () {
    Route::get("/dashboard", function () {
        return Inertia::render("Dashboard");
    })->name("dashboard");
});
