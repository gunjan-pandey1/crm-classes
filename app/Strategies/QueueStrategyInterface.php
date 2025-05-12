<?php
// app/Queue/Strategies/QueueStrategyInterface.php

namespace App\Queue\Strategies;

interface QueueStrategyInterface
{
    /**
     * Enqueue a job to the queue.
     *
     * @param mixed $job
     * @return void
     */
    public function enqueue($job): void;

    /**
     * Dequeue a job from the queue.
     *
     * @return mixed
     */
    public function dequeue();
}
