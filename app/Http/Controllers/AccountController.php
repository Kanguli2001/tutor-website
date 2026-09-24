<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function notifications(Request $request): View
    {
        return view('account.notifications', ['notifications' => $request->user()->notifications()->latest()->paginate(20)]);
    }

    public function markNotificationRead(Request $request, string $notification): RedirectResponse
    {
        $request->user()->notifications()->whereKey($notification)->update(['read_at' => now()]);

        return back();
    }
}
