<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

class CaseConverterController extends Controller
{
    /**
     * Display Converter
     *
     * @return Response
     */
    public function toUppercase(): Response
    {
        $converters = $this->allConverters();
        $page = $converters["to-uppercase"];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "converters" => $converters])->withViewData($page);
    }

    /**
     * Display Converter
     *
     * @return Response
     */
    public function toLowercase(): Response
    {
        $converters = $this->allConverters();
        $page = $converters["to-lowercase"];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "converters" => $converters])->withViewData($page);
    }

    /**
     * Display Converter
     *
     * @return Response
     */
    public function toSentence(): Response
    {
        $converters = $this->allConverters();
        $page = $converters["to-sentencecase"];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "converters" => $converters])->withViewData($page);
    }

    /**
     * Display Converter
     *
     * @return Response
     */
    public function toWord(): Response
    {
        $converters = $this->allConverters();
        $page = $converters["to-wordcase"];

        return Inertia::render("Tools/CaseConverter", ["pageMeta" => $page, "converters" => $converters])->withViewData($page);
    }

    /**
     * Return meta data for all converters
     *
     * @return array
     */
    public function allConverters(): array
    {
        $converters = [];

        $converters["to-lowercase"] = [
            "title" => "UPPERCASE to lowercase converter",
            "description" => "Convert text from uppercase to lowercase",
            "url" => route("tools.case-converter.to-lowercase.show"),
            "convertType" => "to-lowercase",
        ];

        $converters["to-uppercase"] = [
            "title" => "lowercase to UPPERCASE converter",
            "description" => "Convert text from lowercase to uppercase",
            "url" => route("tools.case-converter.to-uppercase.show"),
            "convertType" => "to-uppercase",
        ];

        $converters["to-sentencecase"] = [
            "title" => "Sentence Case converter",
            "description" => "Convert text to sentence case",
            "url" => route("tools.case-converter.to-sentencecase.show"),
            "convertType" => "to-sentencecase",
        ];

        $converters["to-wordcase"] = [
            "title" => "Word Case Converter",
            "description" => "Capitalise each word",
            "url" => route("tools.case-converter.to-wordcase.show"),
            "convertType" => "to-wordcase",
        ];

        return $converters;
    }
}
