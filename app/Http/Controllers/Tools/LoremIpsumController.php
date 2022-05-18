<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoremIpsumController extends Controller
{
    public function show()
    {
        $page = [
            "title" => "Lorem Ipsum Generator",
            "description" => "Generate unlimited and free Lorem Ipsum text for use in your graphic, print and web layouts and explore the origins, history and meaning of Lorem Ipsum.",
            "url" => route("tools.lorem-ipsum"),
        ];

        $faker = \Faker\Factory::create();
        $loremText = $faker->paragraph();

        return Inertia::render("Tools/LoremIpsum", ["pageMeta" => $page, "loremText" => $loremText])->withViewData($page);
    }
}
