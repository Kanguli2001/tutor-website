<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\NewsletterSubscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    public function pricing(): View
    {
        return view('pages.pricing');
    }

    public function faq(): View
    {
        return view('pages.faq');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }

    public function refund(): View
    {
        return view('pages.refund');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function sendContact(Request $request): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:100'], 'email' => ['required', 'email'], 'subject' => ['required', 'string', 'max:160'], 'message' => ['required', 'string', 'max:5000']]);
        ContactMessage::create($data);

        return back()->with('status', 'Your message has been sent. We will be in touch soon.');
    }

    public function subscribe(Request $request): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        NewsletterSubscription::updateOrCreate(['email' => $data['email']], ['active' => true]);

        return back()->with('status', 'You are subscribed to Mawey updates.');
    }

    public function unsubscribe(string $email): View
    {
        return view('pages.unsubscribe', compact('email'));
    }

    public function confirmUnsubscribe(Request $request): RedirectResponse
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        NewsletterSubscription::where('email', $data['email'])->update(['active' => false]);

        return back()->with('status', 'You have been unsubscribed.');
    }
}
