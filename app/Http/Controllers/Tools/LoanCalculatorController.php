<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class LoanCalculatorController extends Controller
{
    /**
     * Show Loan Calculator
     *
     * @return Response
     */
    public function show(): Response
    {
        $page = [
            "title" => "Loan Calculator",
            "description" => "Generate unlimited and free Lorem Ipsum text for use in your graphic, print and web layouts and explore the origins, history and meaning of Lorem Ipsum.",
            "url" => route("tools.loan-calculator.show"),
        ];

        return Inertia::render("Tools/LoanCalculator", ["pageMeta" => $page])->withViewData($page);
    }

    /**
     * Calculate loan amount
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function calculate(Request $request): JsonResponse
    {
        $request->validate([
            "loanAmount" => "required|numeric",
            "loanDuration" => "required|numeric",
            "loanInterestRate" => "required|numeric",
            "honeypot" => "present|max:0",
        ]);

        $loanAmount = $request->get("loanAmount");
        $loanDuration = $request->get("loanDuration");
        $loanDurationType = $request->get("loanDurationType");
        $loanInterestRate = $request->get("loanInterestRate");

        //$loanResult =  P (r (1+r)^n) / ( (1+r)^n -1 );

        $loanRate = $loanInterestRate / 12;
        $loanPeriod = $loanDurationType == "years" ? $loanDuration * 12 : $loanDuration;
        $firstOperand = $loanRate * pow(1 + $loanRate, $loanPeriod);
        $secondOperand = pow(1 + $loanRate, $loanPeriod) - 1;

        debug($loanRate);
        debug($loanPeriod);
        debug($firstOperand);
        debug($secondOperand);

        $loanResult = $loanAmount * ($firstOperand / $secondOperand);
        return response()->json(["loanResult" => $loanResult]);
    }
}
