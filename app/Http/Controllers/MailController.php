<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function index()
    {
        $todayDate = date('Y-m-d');

        $api_url = "https://interview-assessment-1.realmdigital.co.za/employees";

        $employees = Http::get($api_url)->json();

        dd($employees);
    }

    public function sendMail()
    {
        $data = [
            'title' => 'Mail from Birthday wishes',
            'body' => 'This is for testing mail using gmail.'
        ];

        Mail::to("umswaonetjhejo@gmail.com")->send(new SendMail($data));

        return "Basic Email Sent. Check your inbox.";
    }
}
