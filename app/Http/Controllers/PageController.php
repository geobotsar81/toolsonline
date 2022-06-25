<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    /**
     * Show the Home Page
     *
     * @return Response
     */
    public function showHome()
    {
        if (URL::current() != env("APP_URL")) {
            abort(404, "Page not found");
        }

        $page = [
            "title" => "Welcome to FreeOnlineTools",
            "description" => "Find a wide range of calculators and tools for your everyday needs",
            "url" => route("home"),
        ];

        return Inertia::render("Welcome", ["pageMeta" => $page])->withViewData($page);
    }

    /**
     * Show the Terms and Conditions Page
     *
     * @return Response
     */
    public function showTerms(): Response
    {
        $page = [
            "title" => "Terms & Conditions",
            "description" => "Find below the Terms & Conditions that apply to our website",
            "url" => route("terms"),
        ];

        return Inertia::render("TermsOfService", ["pageMeta" => $page])->withViewData($page);
    }

    /**
     * Show the Privacy Policy Page
     *
     * @return Response
     */
    public function showPrivacy(): Response
    {
        $page = [
            "title" => "Privacy Policy",
            "description" => "Find below the Privacy Policy that applies to our website",
            "url" => route("privacy"),
        ];

        return Inertia::render("PrivacyPolicy", ["pageMeta" => $page])->withViewData($page);
    }

    /**
     * Show the All Tools Page
     *
     * @return Response
     */
    public function showAll(): Response
    {
        $page = [
            "title" => "All Tools/Calculators",
            "description" => "Check out below our selection of tools/calculators",
            "url" => route("tools.all"),
        ];

        return Inertia::render("AllTools", ["pageMeta" => $page])->withViewData($page);
    }

    /**
     * Show the Contact Page
     *
     * @return Response
     */
    public function showContact(): Response
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
        $request->validate([
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
