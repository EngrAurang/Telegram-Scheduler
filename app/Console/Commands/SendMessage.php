<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Message to Telegram';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Get the current date and time
        $currentDateTime = now();
        // $this->info($currentDateTime);
        // $currentDateTime = '2023-10-20 14:15:16';
        $currentDateTimeFormatted = date('Y-m-d H:i', strtotime($currentDateTime));

        $messages = Message::whereRaw("DATE_FORMAT(sent_at, '%Y-%m-%d %H:%i') = ?", [$currentDateTimeFormatted])->where('status',"Pending")->get();

        foreach ($messages as $message) {
            $content = $message->message;
            $messageToSend =  $content;

            $this->sendTelegramMessage($messageToSend);
            // Update the status to "sent"
            $message->status = 'Sent';
            $message->save();
            $this->info($messageToSend);
        }

    }

    private function sendTelegramMessage($messageToSend)
    {
        $apiToken = "6481233772:AAE7GlCfU4bjTgm9yKMhNgkoJkq7ecv0keY";

        $data = [
            'chat_id' => '-1001957106090',
            'text' => $messageToSend
        ];

        $response = file_get_contents("http://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
    }
}