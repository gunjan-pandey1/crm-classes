<?php
// app/Queue/Strategies/RedisStrategy.php

namespace App\Queue\Strategies;

use Illuminate\Support\Facades\Redis;

class RedisStrategy implements QueueStrategyInterface
{
    protected $queue = 'redis_queue';

    public function enqueue($job): void
    {
        Redis::rpush($this->queue, json_encode($job));
    }
    
    public function dequeue()
    {
        $jobData = Redis::lpop($this->queue);
        return $jobData ? json_decode($jobData, true) : null;
    }
}
