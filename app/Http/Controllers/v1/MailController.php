<?php

namespace App\Http\Controllers\v1;

use App\Mail\SignupEmail;
use App\Http\Controllers\Controller;
use App\Mail\ApproveID;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($first_name, $email)
    {
        $data = [
            'first_name' => $first_name
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }

    public static function sendApproveID($first_name, $email)
    {
        $data = [
            'first_name' => $first_name
        ];
        Mail::to($email)->send(new ApproveID($data));
    }

    public static function sendForgotPassword($first_name, $email)
    {
        $data = [
            'first_name' => $first_name
        ];
        Mail::to($email)->send(new ForgotPassword($data));
    }
}
