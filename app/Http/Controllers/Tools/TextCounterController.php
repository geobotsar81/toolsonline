<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

class TextCounterController extends Controller
{
    /**
     * Display Tool
     *
     * @return Response
     */
    public function linesCounter(): Response
    {
        $counters = $this->allCounters();
        $page = $counters["lines"];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "counters" => $counters])->withViewData($page);
    }

    /**
     * Display Tool
     *
     * @return Response
     */
    public function sentencesCounter(): Response
    {
        $counters = $this->allCounters();
        $page = $counters["sentences"];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "counters" => $counters])->withViewData($page);
    }

    /**
     * Display Tool
     *
     * @return Response
     */
    public function wordsCounter(): Response
    {
        $counters = $this->allCounters();
        $page = $counters["words"];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "counters" => $counters])->withViewData($page);
    }

    /**
     * Display Tool
     *
     * @return Response
     */
    public function charactersCounters(): Response
    {
        $counters = $this->allCounters();
        $page = $counters["characters"];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "counters" => $counters])->withViewData($page);
    }

    /**
     * Return meta data for all tools
     *
     * @return array
     */
    public function allCounters(): array
    {
        $counters = [];

        $counters["lines"] = [
            "title" => "Lines Counter",
            "description" => "Count number of lines in a given text",
            "url" => route("tools.text-counter.lines-counter.show"),
            "countType" => "lines",
            "icon" => "fal fa-abacus",
        ];

        $counters["sentences"] = [
            "title" => "Sentences Counter",
            "description" => "Count number of sentences in a given text",
            "url" => route("tools.text-counter.sentences-counter.show"),
            "countType" => "sentences",
            "icon" => "fal fa-abacus",
        ];

        $counters["words"] = [
            "title" => "Words Counter",
            "description" => "Count number of words in a given text",
            "url" => route("tools.text-counter.words-counter.show"),
            "countType" => "words",
            "icon" => "fal fa-abacus",
        ];

        $counters["characters"] = [
            "title" => "Characters Counter",
            "description" => "Count number of characters in a given text",
            "url" => route("tools.text-counter.characters-counter.show"),
            "countType" => "characters",
            "icon" => "fal fa-abacus",
        ];

        return $counters;
    }
}
