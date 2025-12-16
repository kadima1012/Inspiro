<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ContactController extends Controller
{
    public function index()
    {
        return view('home.contact');
    }

    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('auner_edy@yahoo.com')->send(new ContactMail($validatedData));

        Session::flash('success', 'Your message has been sent successfully! We will get back to you soon.');

        return back();
    }

}
