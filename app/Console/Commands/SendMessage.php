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
        //  $currentDateTime = now();
        $currentDateTime = '2023-10-20 14:15:16';
        $currentDateTimeFormatted = date('Y-m-d H:i', strtotime($currentDateTime));

        $messages = Message::whereRaw("DATE_FORMAT(sent_at, '%Y-%m-%d %H:%i') = ?", [$currentDateTimeFormatted])->get();

        // foreach ($messages as $message) {
        //     $message = $message->message;
        //     $this->sendTelegramMessage($message);
        //     $this->info($message);
        // }

        foreach ($messages as $message) {
            $title = $message->title; // Assuming you have a 'title' field in your 'Message' model
            $content = $message->message;
            $messageToSend = "Title" ." : ". $title . "\n" . "Message" ." : ". $content; // Combine title and message

            $this->sendTelegramMessage($messageToSend);
            // Send your message or perform any other action here
            $this->info($messageToSend);
        }

    }

    private function sendTelegramMessage($message)
    {
        $apiToken = "6651277985:AAH24E6K1BET_1PeAnATsdAQ4f9OBKTi4H8";

        $data = [
            'chat_id' => '@MessagesSchedularbot',
            'text' => $message
        ];

        $response = file_get_contents("http://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
    }
}