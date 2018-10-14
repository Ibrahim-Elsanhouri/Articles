<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;

use App\Mail\ContactUs;

class PagesController extends Controller
{
    //
    public function about(){
        return view ('pages.about');
    }
    public function contactus(){
        return view ('pages.contactus');
    }
    public function dosend(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'body' => 'required',
            'subject' => 'required',
            'email' => 'required',
         ]);
        $name = $request->input('name');
        $body = $request->input('body');
        $subject = $request->input('subject');
        $email = $request->input('email');
        SendEmailJob::dispatch($name, $email , $body , $subject);
       // Mail::to('ibrahimelsanhouri@gmail.com')->send(new ContactUs($name , $body , $subject , $email));
        return redirect('/contact')->with('success','We have received your email , we will answer you soon ! '); 
    }
}


