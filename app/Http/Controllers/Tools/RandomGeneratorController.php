<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
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
            "icon" => "fal fa-random",
        ];

        $generators["password"] = [
            "title" => "Random password generator",
            "description" => "Generate a random password",
            "url" => route("tools.random-generator.random-password.show"),
            "convertType" => "random-password",
            "icon" => "fal fa-random",
        ];

        $generators["word"] = [
            "title" => "Random word generator",
            "description" => "Generate a random word",
            "url" => route("tools.random-generator.random-word.show"),
            "convertType" => "random-word",
            "icon" => "fal fa-random",
        ];

        $generators["sentence"] = [
            "title" => "Random sentence generator",
            "description" => "Generate a random sentence",
            "url" => route("tools.random-generator.random-sentence.show"),
            "convertType" => "random-sentence",
            "icon" => "fal fa-random",
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
        $faker = \Faker\Factory::create();

        $outputLength = $request["outputLength"];
        $outputType = $request["outputType"];

        if ($outputType == "random-number") {
            $request->validate([
                "outputLength" => "required|numeric|max:9",
                "honeypot" => "present|max:0",
            ]);
        } else {
            $request->validate([
                "outputLength" => "required|numeric",
                "honeypot" => "present|max:0",
            ]);
        }

        if ($outputType == "random-number") {
            $output = $faker->randomNumber($outputLength, true);
        }

        if ($outputType == "random-password") {
            $output = $this->generateStrongPassword($outputLength);
        }

        if ($outputType == "random-word") {
            $output = Str::random($outputLength);
        }

        if ($outputType == "random-sentence") {
            $output = $faker->sentence($outputLength, true);
        }

        return response()->json(["output" => $output]);
    }

    function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = "luds")
    {
        $sets = [];
        if (strpos($available_sets, "l") !== false) {
            $sets[] = "abcdefghjkmnpqrstuvwxyz";
        }
        if (strpos($available_sets, "u") !== false) {
            $sets[] = "ABCDEFGHJKMNPQRSTUVWXYZ";
        }
        if (strpos($available_sets, "d") !== false) {
            $sets[] = "23456789";
        }
        if (strpos($available_sets, "s") !== false) {
            $sets[] = '!@#$%&*?';
        }

        $all = "";
        $password = "";
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++) {
            $password .= $all[array_rand($all)];
        }

        $password = str_shuffle($password);

        if (!$add_dashes) {
            return $password;
        }

        $dash_len = floor(sqrt($length));
        $dash_str = "";
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . "-";
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}
