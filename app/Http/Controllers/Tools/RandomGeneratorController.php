<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RandomGeneratorController extends Controller
{
    /**
     * Display Random Generator
     *
     * @return Response
     */
    public function randomNumber(): Response
    {
        $generators = $this->allGenerators();
        $page = $generators["number"];

        return Inertia::render("Tools/RandomGenerator", ["pageMeta" => $page, "generators" => $generators])->withViewData($page);
    }

    /**
     * Display Random Generator
     *
     * @return Response
     */
    public function randomPassword(): Response
    {
        $generators = $this->allGenerators();
        $page = $generators["password"];

        return Inertia::render("Tools/RandomGenerator", ["pageMeta" => $page, "generators" => $generators])->withViewData($page);
    }

    /**
     * Display Random Generator
     *
     * @return Response
     */
    public function randomWord(): Response
    {
        $generators = $this->allGenerators();
        $page = $generators["word"];

        return Inertia::render("Tools/RandomGenerator", ["pageMeta" => $page, "generators" => $generators])->withViewData($page);
    }

    /**
     * Display Random Generator
     *
     * @return Response
     */
    public function randomSentence(): Response
    {
        $generators = $this->allGenerators();
        $page = $generators["sentence"];

        return Inertia::render("Tools/RandomGenerator", ["pageMeta" => $page, "generators" => $generators])->withViewData($page);
    }

    /**
     * Return meta data for all generators
     *
     * @return array
     */
    public function allGenerators(): array
    {
        $generators = [];

        $generators["number"] = [
            "title" => "Random number generator",
            "description" => "Generate a random number",
            "url" => route("tools.random-generator.random-number.show"),
            "convertType" => "random-number",
        ];

        $generators["password"] = [
            "title" => "Random password generator",
            "description" => "Generate a random password",
            "url" => route("tools.random-generator.random-password.show"),
            "convertType" => "random-password",
        ];

        $generators["word"] = [
            "title" => "Random word generator",
            "description" => "Generate a random word",
            "url" => route("tools.random-generator.random-word.show"),
            "convertType" => "random-word",
        ];

        $generators["sentence"] = [
            "title" => "Random sentence generator",
            "description" => "Generate a random sentence",
            "url" => route("tools.random-generator.random-sentence.show"),
            "convertType" => "random-sentence",
        ];

        return $generators;
    }

    /**
     * Generate Lorem Ipsum text
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            "outputLength" => "required|numeric",
            "honeypot" => "present|max:0",
        ]);

        $faker = \Faker\Factory::create();

        $outputLength = $request["outputLength"];
        $outputType = $request["outputType"];

        if ($outputType == "random-number") {
            $output = $faker->words($outputLength, true);
        }

        if ($outputType == "sentences") {
            $output = $faker->sentences($outputLength);
        }

        return response()->json(["output" => $output]);
    }
}
