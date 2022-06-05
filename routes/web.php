<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Tools\LoremIpsumController;
use App\Http\Controllers\Tools\TextCounterController;
use App\Http\Controllers\Tools\BMICalculatorController;
use App\Http\Controllers\Tools\CaseConverterController;
use App\Http\Controllers\Tools\LoanCalculatorController;

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
Route::get("/terms-and-conditions", [PageController::class, "showTerms"])->name("terms");
Route::get("/privacy-policy", [PageController::class, "showPrivacy"])->name("privacy");
Route::get("/sitemap.xml", [SitemapController::class, "index"]);

Route::prefix("/tools")
    ->name("tools.")
    ->group(function () {
        Route::get("/all", [PageController::class, "showAll"])->name("all");

        //Lorem Ipsum
        Route::get("/lorem-ipsum-generator", [LoremIpsumController::class, "show"])->name("lorem-ipsum.show");
        Route::post("/lorem-ipsum-generator", [LoremIpsumController::class, "generate"])->name("lorem-ipsum.generate");

        //Loan Calculator
        Route::get("/loan-calculator", [LoanCalculatorController::class, "show"])->name("loan-calculator.show");
        Route::post("/loan-calculator", [LoanCalculatorController::class, "calculate"])->name("loan-calculator.calculate");

        //Loan Calculator
        Route::get("/bmi-calculator", [BMICalculatorController::class, "show"])->name("bmi-calculator.show");
        Route::post("/bmi-calculator", [BMICalculatorController::class, "calculate"])->name("bmi-calculator.calculate");

        //Case Converters
        Route::prefix("/case-converter")
            ->name("case-converter.")
            ->group(function () {
                Route::get("/lowercase-to-uppercase-converter", [CaseConverterController::class, "toUppercase"])->name("to-uppercase.show");
                Route::get("/uppercase-to-lowercase-converter", [CaseConverterController::class, "toLowercase"])->name("to-lowercase.show");
                Route::get("/sentence-case-converter", [CaseConverterController::class, "toSentence"])->name("to-sentencecase.show");
                Route::get("/word-case-converter", [CaseConverterController::class, "toWord"])->name("to-wordcase.show");
            });

        //Text Counter
        Route::prefix("/text-counter")
            ->name("text-counter.")
            ->group(function () {
                Route::get("/lines-counter", [TextCounterController::class, "linesCounter"])->name("lines-counter.show");
                Route::get("/sentences-counter", [TextCounterController::class, "sentencesCounter"])->name("sentences-counter.show");
                Route::get("/words-counter", [TextCounterController::class, "wordsCounter"])->name("words-counter.show");
                Route::get("/characters-counter", [TextCounterController::class, "charactersCounters"])->name("characters-counter.show");
            });
    });

Route::middleware(["auth:sanctum", config("jetstream.auth_session"), "verified"])->group(function () {
    Route::get("/dashboard", function () {
        return Inertia::render("Dashboard");
    })->name("dashboard");
});
