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
        return Inertia::render("Welcome", [
            "canLogin" => Route::has("login"),
            "canRegister" => Route::has("register"),
            "laravelVersion" => Application::VERSION,
            "phpVersion" => PHP_VERSION,
        ]);
    }

    public function showContact()
    {
        $page = [
            "title" => "Contact Us",
            "description" => "Got any questions? Send as an email",
            "url" => route("contact.send"),
        ];

        return Inertia::render("Contact", [
            "page" => $page,
        ])->withViewData($page);
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
