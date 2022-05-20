<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CaseConverterController extends Controller
{
    public function toUppercase()
    {
        $page = [
            "title" => "Lowercase to Uppercase converter",
            "description" => "Convert text from lowercase to uppercase",
            "url" => route("tools.case-converter.to-uppercase.show"),
        ];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "convertType" => "to-uppercase"])->withViewData($page);
    }

    public function toLowercase()
    {
        $page = [
            "title" => "Uppercase to Lowercase converter",
            "description" => "Convert text from uppercase to lowercase",
            "url" => route("tools.case-converter.to-lowercase.show"),
        ];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "convertType" => "to-lowercase"])->withViewData($page);
    }

    public function toSentence()
    {
        $page = [
            "title" => "Sentence case converter",
            "description" => "Convert text to sentence case",
            "url" => route("tools.case-converter.to-sentencecase.show"),
        ];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "convertType" => "to-sentencecase"])->withViewData($page);
    }
}
