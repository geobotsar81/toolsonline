<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class TextCounterController extends Controller
{
    public function linesCounter(): Response
    {
        $page = [
            "title" => "Lines Counter",
            "description" => "Count number of lines in a given text",
            "url" => route("tools.text-counter.lines-counter.show"),
        ];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "countType" => "lines"])->withViewData($page);
    }

    public function sentencesCounter(): Response
    {
        $page = [
            "title" => "Sentences Counter",
            "description" => "Count number of sentences in a given text",
            "url" => route("tools.text-counter.sentences-counter.show"),
        ];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "countType" => "sentences"])->withViewData($page);
    }

    public function wordsCounter(): Response
    {
        $page = [
            "title" => "Words Counter",
            "description" => "Count number of words in a given text",
            "url" => route("tools.text-counter.words-counter.show"),
        ];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "countType" => "words"])->withViewData($page);
    }

    public function charactersCounters(): Response
    {
        $page = [
            "title" => "Characters Counter",
            "description" => "Count number of characters in a given text",
            "url" => route("tools.text-counter.characters-counter.show"),
        ];

        return Inertia::render("Tools/TextCounter", ["pageMeta" => $page, "countType" => "characters"])->withViewData($page);
    }
}
