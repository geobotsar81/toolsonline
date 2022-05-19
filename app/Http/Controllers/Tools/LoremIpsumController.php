<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class LoremIpsumController extends Controller
{
    public function show()
    {
        $page = [
            "title" => "Lorem Ipsum Generator",
            "description" => "Generate unlimited and free Lorem Ipsum text for use in your graphic, print and web layouts and explore the origins, history and meaning of Lorem Ipsum.",
            "url" => route("tools.lorem-ipsum.show"),
        ];

        $faker = \Faker\Factory::create();

        $loremText = [];
        for ($i = 0; $i < 5; $i++) {
            array_push($loremText, $faker->paragraph(7));
        }

        return Inertia::render("Tools/LoremIpsum", ["pageMeta" => $page, "loremText" => $loremText])->withViewData($page);
    }

    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            "loremNumber" => "required|numeric",
            "honeypot" => "present|max:0",
        ]);

        $faker = \Faker\Factory::create();

        $loremType = $request["loremType"];
        $loremNumber = $request["loremNumber"];

        if ($loremType == "words") {
            $loremText = $faker->words($loremNumber, true);
        }

        if ($loremType == "sentences") {
            $loremText = $faker->sentences($loremNumber);
        }

        if ($loremType == "paragraphs") {
            $loremText = [];

            for ($i = 0; $i < $loremNumber; $i++) {
                array_push($loremText, $faker->paragraph(7));
            }
        }

        debug($loremText);

        return response()->json(["loremText" => $loremText]);
    }
}
