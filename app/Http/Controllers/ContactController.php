<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Notifications\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    //
    public function __invoke(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:244',
            'lastname' => 'required|string|max:244',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|string'
        ]);
        Notification::route('mail', 'inqnatevosyanarman@gmail.com')->notify(new ContactUs($request->get('firstname'),$request->get('lastname'), $request->get('email'), $request->get('phone'), $request->get('message')));
        return Contact::query()->create($validatedData);
    }
}
