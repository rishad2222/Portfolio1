<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ContactFormController extends Controller
{
    Public function store(){
        $contact_form_data = request()->all();
        Mail::to('rihad.mahin803@gmail.com')->send(new ContactFormMail($contact_form_data));

        return redirect()->route('home','/#contact')->with('success','Your message has been submitted successfully');
    }

    
}
