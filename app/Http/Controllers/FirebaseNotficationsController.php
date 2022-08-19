<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7;
use App\Models\Topic;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


class FirebaseNotficationsController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        return view('notification-home');
    }

    public function storeToken(Request $request)
    {
        auth()->user()->update(['device_key' => $request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(Request $request)
    {

        // $topic_id = $request->topic;
        // $firebaseToken = User::whereHas('topics', function($query) use ($topic_id){
        //     return $query->where('topic_id', $topic_id);
        // })->whereNotNull('device_key')->pluck('device_key')->all();


        // $topic = Topic::find($request->topic);
        // $firebaseToken = $topic->users()->whereNotNull('device_key')->pluck('device_key')->all();

        $firebaseToken = User::whereNotNull('device_key')->pluck('device_key')->all();

        $SERVER_API_KEY = 'AAAAFDsKQrI:APA91bEg1vdwx8ODl87SEzcnRFAzU6WWNkgMexThqbvYPe5NMM2mK4ccPCWTD0SU2ZgBz4A29I8oo7xT2bHWzxWUM3MDq5QeRajkZJINPLgwF9mgkhEHHntNG1MENOr3DpZigotJfQfk';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $response = curl_exec($ch);

        // $client = new Client();
        // $array_of_parameters = [
        //     // Base URI is used with relative requests
        //     'CURLOPT_URL' => 'https://fcm.googleapis.com/fcm/send',
        //     "CURLOPT_POST" => true,
        //     "CURLOPT_HTTPHEADER" => $headers,
        //     "CURLOPT_SSL_VERIFYPEER" => false,
        //     "CURLOPT_RETURNTRANSFER" => true,
        //     "CURLOPT_POSTFIELDS" => $dataString,
        // ];

        // $response = $client->request('POST', [
        //     'form_params' => $array_of_parameters,
        // ]);

        return view('show-notification', compact('response'));
        // dd($response);
    }
}
