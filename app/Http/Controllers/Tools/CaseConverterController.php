<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CaseConverterController extends Controller
{
    public function toUppercase(): Response
    {
        $page = [
            "title" => "lowercase to UPPERCASE converter",
            "description" => "Convert text from lowercase to uppercase",
            "url" => route("tools.case-converter.to-uppercase.show"),
        ];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "convertType" => "to-uppercase"])->withViewData($page);
    }

    public function toLowercase(): Response
    {
        $page = [
            "title" => "UPPERCASE to lowercase converter",
            "description" => "Convert text from uppercase to lowercase",
            "url" => route("tools.case-converter.to-lowercase.show"),
        ];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "convertType" => "to-lowercase"])->withViewData($page);
    }

    public function toSentence(): Response
    {
        $page = [
            "title" => "Sentence Case converter",
            "description" => "Convert text to sentence case",
            "url" => route("tools.case-converter.to-sentencecase.show"),
        ];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "convertType" => "to-sentencecase"])->withViewData($page);
    }

    public function toWord(): Response
    {
        $page = [
            "title" => "Word Case Converter",
            "description" => "Capitalise each word",
            "url" => route("tools.case-converter.to-wordcase.show"),
        ];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "convertType" => "to-wordcase"])->withViewData($page);
    }
}
