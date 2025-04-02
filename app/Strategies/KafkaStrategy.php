<?php
// app/Queue/Strategies/KafkaStrategy.php

// namespace App\Queue\Strategies;

// class KafkaStrategy implements QueueStrategyInterface
// {
//     protected $producer;
//     protected $consumer;

//     public function __construct()
//     {
//         // Initialization using a Kafka PHP client such as php-rdkafka
//         $conf = new \RdKafka\Conf();
//         // Set necessary configuration options (group.id, broker list, etc.)
//         $this->producer = new \RdKafka\Producer($conf);
//         $this->producer->addBrokers(env('KAFKA_BROKERS', 'localhost:9092'));
        
//         $consumerConf = new \RdKafka\Conf();
//         $consumerConf->set('group.id', 'laravel_queue');
//         $this->consumer = new \RdKafka\KafkaConsumer($consumerConf);
//         $this->consumer->subscribe(['kafka_topic']);
//     }
    
//     public function enqueue($job): void
//     {
//         $topic = $this->producer->newTopic('kafka_topic');
//         $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($job));
//         $this->producer->flush(1000);
//     }
    
//     public function dequeue()
//     {
//         $message = $this->consumer->consume(120 * 1000);
//         if ($message->err) {
//             \Log::error("Kafka Error: {$message->errstr()}");
//             return null;
//         }
//         return json_decode($message->payload, true);
//     }
// }
