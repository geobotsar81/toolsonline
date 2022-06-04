<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Display the sitemap
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()
            ->view("sitemap", [])
            ->header("Content-Type", "text/xml");
    }
}
