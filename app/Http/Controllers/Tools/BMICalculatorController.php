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
            "description" => "Determine your Body Mass Index. For ages 20+.",
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
        $bmiResult = null;

        $request->validate([
            "bmiHeight" => "required|numeric",
            "bmiWeight" => "required|numeric",
            "honeypot" => "present|max:0",
        ]);

        $bmiHeight = $request->get("bmiHeight");
        $bmiHeight2 = $request->get("bmiHeight2");
        $bmiWeight = $request->get("bmiWeight");
        $bmiUnit = $request->get("bmiUnit");

        if ($bmiUnit == "US Units") {
            $bmiHeight = (($bmiHeight * 12 + $bmiHeight2) * 2.54) / 100;
            $bmiWeight *= 0.453592;
        } else {
            $bmiHeight = $bmiHeight / 100;
        }

        $bmiResult = $bmiWeight / ($bmiHeight * $bmiHeight);

        $bmiResult = round($bmiResult, 2);

        return response()->json([
            "bmiResult" => $bmiResult,
        ]);
    }
}
