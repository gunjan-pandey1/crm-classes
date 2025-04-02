<?php

namespace Tests\Feature\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class ConcurrentAuthTest extends TestCase
{
    // Total number of requests for the stress test.
    private const TOTAL_REQUESTS = 1000;
    // Concurrency level to limit simultaneous connections.
    private const CONCURRENCY = 50;

    #[\PHPUnit\Framework\Attributes\Test]
    public function homepage_stress_test()
    {
        Log::info('Starting concurrent homepage stress test');

        $client = new Client();
        // Create a generator that yields GET requests.
        $requests = function ($total) {
            for ($i = 0; $i < $total; $i++) {
                yield new Request('GET', 'http://localhost:8000/');
            }
        };

        $successCount = 0;
        $failureCount = 0;

        $pool = new Pool($client, $requests(self::TOTAL_REQUESTS), [
            'concurrency' => self::CONCURRENCY,
            'fulfilled' => function ($response, $index) use (&$successCount) {
                $statusCode = $response->getStatusCode();
                Log::info("Request #" . ($index + 1) . " succeeded with status code: " . $statusCode);
                if ($statusCode === 200) {
                    $successCount++;
                }
            },
            'rejected' => function ($reason, $index) use (&$failureCount) {
                Log::error("Request #" . ($index + 1) . " failed: " . $reason);
                $failureCount++;
            },
        ]);

        // Initiate the transfers and wait for them to complete.
        $promise = $pool->promise();
        $promise->wait();

        Log::info("Test completed. Success: $successCount, Failures: $failureCount");

        // Assert that at least one request succeeded.
        $this->assertGreaterThan(0, $successCount, 'No successful responses received.');

        // Optionally, assert that a minimum percentage of requests succeeded.
        $successRate = $successCount / self::TOTAL_REQUESTS;
        Log::info("Success rate: " . ($successRate * 100) . "%");
        // For example, assert that at least 80% of the requests succeeded.
        $this->assertGreaterThanOrEqual(0.8, $successRate, "Success rate is below expected threshold. (Success rate: " . ($successRate * 100) . "%)");
    }
}
