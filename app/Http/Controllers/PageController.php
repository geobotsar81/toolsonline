<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

class PageController extends Controller
{
    public function showHome()
    {
        $page = [
            "title" => "Welcome",
            "description" => "FreeOnlineTools, the home of a variety of online tools",
            "url" => route("home"),
        ];

        return Inertia::render("Welcome", ["pageMeta" => $page])->withViewData($page);
    }

    public function showTerms()
    {
        $page = [
            "title" => "Terms & Conditions",
            "description" => "Find below the Terms & Conditions that apply to our website",
            "url" => route("home"),
        ];

        return Inertia::render("TermsOfService", ["pageMeta" => $page])->withViewData($page);
    }

    public function showAll()
    {
        $page = [
            "title" => "All Tools/Calculators",
            "description" => "Check out below our selection of tools/calculators",
            "url" => route("tools.all"),
        ];

        return Inertia::render("AllTools", ["pageMeta" => $page])->withViewData($page);
    }

    public function showContact()
    {
        $page = [
            "title" => "Contact Us",
            "description" => "Got any questions? Send as an email",
            "url" => route("contact.send"),
        ];

        return Inertia::render("Contact", ["pageMeta" => $page])->withViewData($page);
    }

    /**
     * Validate the contact form and send the contact email
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendMail(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "contactName" => "required",
            "contactEmail" => "email:rfc,dns",
            "contactMessage" => "required",
            "honeypot" => "present|max:0",
        ]);

        $contact = [
            "fullname" => $request["contactName"],
            "email" => $request["contactEmail"],
            "subject" => "Email from Contact Form",
            "message" => $request["contactMessage"],
        ];

        Mail::to(config("mail.from.address"))->send(new ContactFormMail($contact));
        return redirect()->back();
    }
}
