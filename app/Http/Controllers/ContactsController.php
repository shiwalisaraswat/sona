<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Contact;

class ContactsController extends Controller
{

    public function index(Request $request): View
    {
        $record = new Contact();

        return view('contact', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        $user = auth()->user();

        Contact::create([
            'user_id' => $user?->id,
            'name'    => $user?->name ?? $request->name,
            'email'   => $user?->email ?? $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Contact Info sent successfully!');
    }


}
