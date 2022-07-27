<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NotificationTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TopicNotificationController extends Controller
{
    public function send(){
        $users = User::all();
        $userData = [
            'greeting' => 'sss',
            'body' => 'ddd',
            'thanks' => 'aaaa',
        ];

        // $user->notify(new NotificationTopic($userData));
        Notification::send($users, new NotificationTopic($userData));

        // if(!$success){
        //     return response()->final(401, 'Somthing went wrong');
        // }
        // return response()->success($success);
    }
}
