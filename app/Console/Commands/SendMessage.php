<?php

namespace App\Console\Commands;

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
         $this->info('Sending a message at ' . $currentDateTime);
         // Define the expected sent_at format
         $expectedSentAt = '2023-10-22 10:00:00';

         // Check if the current date and time match the expected format
         if ($currentDateTime->format('Y-m-d H:i:s') === $expectedSentAt) {
             // Send your message here
             $this->info('Sending a message at ' . $expectedSentAt);
         }
    }
}