<?php

namespace App\Http\Controllers\Tools;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class InternetSpeedTestController extends Controller
{
    /**
     * Show Internet Speed Test
     *
     * @return Response
     */
    public function show(): Response
    {
        $page = [
            "title" => "Internet Speed Test",
            "description" => "Use Speedtest on all your devices with our free desktop and mobile apps.",
            "url" => route("tools.internet-speed-test.show"),
        ];

        return Inertia::render("Tools/InternetSpeedTest", ["pageMeta" => $page])->withViewData($page);
    }
}
