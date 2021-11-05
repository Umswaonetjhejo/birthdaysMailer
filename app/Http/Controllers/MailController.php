<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function sendMail()
    {
        $data = [
            'title' => 'Mail from Birthday wishes',
            'body' => 'This is for testing mail using gmail.'
        ];

        Mail::to("umswa1994@gmail.com")->send(new SendMail($data));

        return "Basic Email Sent. Check your inbox.";
    }
}
