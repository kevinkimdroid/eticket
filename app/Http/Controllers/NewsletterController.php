<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        // TODO: Store email (e.g. newsletter_subscribers table) and send to Mailchimp/etc
        return redirect()->back()->with('success', 'Thanks! You\'re subscribed to our newsletter.');
    }
}
