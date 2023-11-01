<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;

class FirebaseController extends Controller
{
    public function sendAll(Request $request)
    {
        $recipients = User::whereNotNull('device_token')->pluck('device_token')->toArray();
        // dd($users)

        fcm()
            ->to($recipients)
            ->notification([
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ])
            ->send();
        $notification = 'Notificacion enviada a todos los usuarios (android).';
        return back()->with(compact('notification'));
    }
}
