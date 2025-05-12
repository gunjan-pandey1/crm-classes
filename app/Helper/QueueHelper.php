<?php
// app/Queue/Helpers/QueueHelper.php

namespace App\Queue\Helpers;

use Illuminate\Support\Facades\Log;

class QueueHelper
{
    public static function formatJobData(array $data): array
    {
        // Perform data validation or formatting
        return $data;
    }
    
    public static function logJob(string $message): void
    {
        Log::info($message);
    }
}
