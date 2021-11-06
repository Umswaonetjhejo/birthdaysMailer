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
        //Get today's day and month
        $todayDate = date('m-d');
        //$todayDate = "02-28";//"11-17";

        //Check if this year is a leap year
        $leapYear = date('L');

        //API variable
        $api_url = "https://interview-assessment-1.realmdigital.co.za/employees";

        //API call to get the employees
        $employees = Http::get($api_url)->json();

        //String variable to populate with the names of those who's birthday is today.
        $stringName = "";

        //Loop to get names of those who's birthday is today
        for($c = 0; $c < count($employees); $c++)
        {
            //Check if each elements of the array has a date of birth
            if(isset($employees[$c]['dateOfBirth']))
            {
                //Check if an employee's birthday is today and if it's leap year, check if the employee's birth month and February and birthday is on the 29th
                if(date('m-d', strtotime($employees[$c]['dateOfBirth'])) == $todayDate || ($leapYear == 0 && date('m-d', strtotime($employees[$c]['dateOfBirth'])) == "02-29"))
                {
                    $stringName .= $employees[$c]['name']." ".$employees[$c]['lastname'].", ";
                }

            }
        }

        //dd($stringName);

        return $this->sendMail($stringName);
    }

    public function sendMail($names)
    {
        $data = [
            'title' => 'Birthday wishes',
            'body' => 'Happy Birthday '.$names
        ];

        Mail::to("umswaonetjhejo@gmail.com")->send(new SendMail($data));

        return "Basic Email Sent. Check your inbox.";
    }
}
