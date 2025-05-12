<?php
// app/Console/Commands/ConsumeQueue.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Queue\Factories\QueueFactory;
use App\Queue\Handlers\JobHandler;

class ConsumeQueue extends Command
{
    protected $signature = 'queue:consume';
    protected $description = 'Consume jobs from the queue';

    public function handle()
    {
        $queue = QueueFactory::make();
        $jobHandler = new JobHandler();

        $this->info("Starting queue consumer...");

        while (true) {
            $job = $queue->dequeue();
            if ($job) {
                $jobHandler->handle($job);
            }
            // You may add sleep or wait logic as needed.
        }
    }
}
