<?php
// app/Queue/Strategies/RabbitMQStrategy.php

namespace App\Queue\Strategies;

use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQStrategy implements QueueStrategyInterface
{
    protected $connection;
    protected $channel;
    
    public function __construct()
    {
        // Initialize connection using environment variables
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', '127.0.0.1'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASSWORD', 'guest')
        );
        $this->channel = $this->connection->channel();
    }
    
    public function enqueue($job): void
    {
        $msg = new AMQPMessage(json_encode($job));
        $this->channel->basic_publish($msg, '', 'queue_name');
    }
    
    public function dequeue()
    {
        // Basic example; you would normally use a consumer callback
        $callback = function ($msg) {
            // Process job message
            // For example, pass the message to a handler
            Log::info('Received job: ' . $msg->body);
            $msg->ack();
        };

        $this->channel->basic_consume('queue_name', '', false, false, false, false, $callback);
        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
