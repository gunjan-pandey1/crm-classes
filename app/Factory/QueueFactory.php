<?php
// app/Queue/Factories/QueueFactory.php

namespace App\Queue\Factories;

use App\Queue\Strategies\RabbitMQStrategy;
use App\Queue\Strategies\RedisStrategy;
use App\Queue\Strategies\KafkaStrategy;
use App\Queue\Strategies\QueueStrategyInterface;

class QueueFactory
{
    /**
     * Return an instance of a queue strategy based on configuration.
     *
     * @return QueueStrategyInterface
     * @throws \Exception
     */
    public static function make(): QueueStrategyInterface
    {
        $driver = config('queue.driver'); // e.g., 'rabbitmq', 'redis', or 'kafka'

        switch ($driver) {
            case 'rabbitmq':
                return new RabbitMQStrategy();
            case 'redis':
                return new RedisStrategy();
            // case 'kafka':
                // return new KafkaStrategy();
            default:
                throw new \Exception("Queue driver [$driver] is not supported.");
        }
    }
}
