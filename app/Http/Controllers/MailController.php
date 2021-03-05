<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title'=>'Mail form vuong luong',
            'body' => 'Đây là mail sử dụng gmail'
        ];

        Mail::to("vuongxang02@gmail.com")->send(new TestMail($details));
        return "Email sent";
    }

    public function sendContact(Request $request)
    {

        $details = [
            'title'=>'Liên hệ bởi'.$request->name,
            'body' => 
                'Số điện thoại: '.$request->phone.'</br>'.
                'email: '.$request->email.'</br>'.
                'Nội dung: '.$request->content
        ];

        Mail::to("vuongxang@gmail.com")->send(new TestMail($details));
        return view('pages.contact',['message'=>'Liên hệ thành công']);
    }
}
