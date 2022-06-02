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
            "description" =>
                "Determine the monthly payments on a loan. Simply enter the loan amount, term and interest rate in the fields below and click calculate. It can be used for mortgage, auto, or any other fixed loan types.",
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

        $loanRate = $loanInterestRate / 12 / 100;
        $loanPeriod = $loanDurationType == "years" ? $loanDuration * 12 : $loanDuration;
        $firstOperand = $loanRate * pow(1 + $loanRate, $loanPeriod);
        $secondOperand = pow(1 + $loanRate, $loanPeriod) - 1;

        $loanMonthly = $loanAmount * ($firstOperand / $secondOperand);
        $loanTotal = $loanMonthly * $loanPeriod;
        $loanInterestPaid = $loanTotal - $loanAmount;

        return response()->json([
            "loanMonthly" => number_format($loanMonthly, 2, ".", ","),
            "loanTotal" => number_format($loanTotal, 2, ".", ","),
            "loanInterestPaid" => number_format($loanInterestPaid, 2, ".", ","),
        ]);
    }
}
