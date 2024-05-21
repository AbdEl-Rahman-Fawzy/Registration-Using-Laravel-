<?php
// MailController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class MailController extends Controller
{
    public function sendEmail($email)
    {
        $ToEmail = $email;
        $message = 'registration successful';
        $subject = 'Registration';

        Log::info('Sending email to: ' . $ToEmail);
        Mail::to($ToEmail)->send(new WelcomeEmail($message, $subject));
        Log::info('Email sent successfully');

        return response()->json(['message' => 'Email sent successfully']);
    }

}


