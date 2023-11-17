<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Log;

class TestMailController extends Controller
{
    public function send(Request $request)
    {
        Log::info("sent");
        $details = [
            'title' => 'Mail from websitepercobaan.com',
            'body' => 'This is for testing email using smtp'
        ];

        Mail::to($request->mail)->send(new TestMail());

        dd("Email sudah terkirim ke " . $request->email);

    }
}
