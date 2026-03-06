<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('home.contact');
    }

    public function send(ContactRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Mail::to(config('mail.from.address'))->send(new ContactMail($validated));

        return redirect()->back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}
