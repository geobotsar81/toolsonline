<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class BMICalculatorController extends Controller
{
    /**
     * Show BMI Calculator
     *
     * @return Response
     */
    public function show(): Response
    {
        $page = [
            "title" => "BMI Calculator",
            "description" => "Determine your Body Mass Index.",
            "url" => route("tools.bmi-calculator.show"),
        ];

        return Inertia::render("Tools/BMICalculator", ["pageMeta" => $page])->withViewData($page);
    }

    /**
     * Calculate BMI
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function calculate(Request $request): JsonResponse
    {
        $request->validate([
            "bmiHeight" => "required|numeric",
            "bmiWeight" => "required|numeric",
            "bmiAge" => "required|numeric",
            "honeypot" => "present|max:0",
        ]);

        $bmiHeight = $request->get("bmiHeight");
        $bmiWeight = $request->get("bmiWeight");
        $bmiUnit = $request->get("bmiUnit");
        $bmiAge = $request->get("bmiAge");

        return response()->json([
            "bmiResult" => "",
            "bmiDescription" => "",
        ]);
    }
}
