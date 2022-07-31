<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\NotificationTopic;
use Illuminate\Support\Facades\Notification;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send {topic_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to the users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if($this->argument('topic_id')){
            $users = User::whereHas('topics', function($query) {
                return $query->where('topic_id', $this->argument('topic_id'));
            })->get();
        } else {
            $users = User::whereHas('topics')->get();
        }


        $userData = [
            'greeting' => 'Hello',
            'body' => 'this is notification body',
            'thanks' => 'thank you :)',
        ];


        // $user->notify(new NotificationTopic($userData));
        Notification::send($users, new NotificationTopic($userData));
        echo "notification sent successfully..";
    }
}
