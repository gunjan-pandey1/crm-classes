<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Algolia\AlgoliaSearch\Api\SearchClient;
use App\Models\CrmUser;
use Illuminate\Support\Facades\Log;

class AlgoliaDbInsert extends Command
{
    protected $signature = 'app:algolia-db-insert';
    protected $description = 'Insert bulk database records into Algolia search index';

    public function handle()
    {
        $this->info('Starting Algolia database import...');
        Log::info('Starting Algolia database import process');

        try {
            // Initialize the Algolia client with your credentials
            $client = $this->initializeAlgoliaClient();

            $totalUsers = 0;
            // Process users in chunks of 100
            CrmUser::chunk(100, function($users) use ($client, &$totalUsers) {
                $records = $users->map(function($user) {
                    return [
                        'objectID' => rand(1, 1000000),
                        'name'     => $user->name,
                        'email'    => $user->email,
                        'phone'    => $user->phone,
                    ];
                })->toArray();

                // Save records to the specified Algolia index.
                // This mimics the reference sample's approach.
                $client->saveObjects('crm_shetty_class', $records);

                $totalUsers += count($records);
                $this->info("Imported {$totalUsers} users so far...");
                Log::info("Batch import: {$totalUsers} users processed");
            });

            $this->info("Total records imported - Users: {$totalUsers}");
            Log::info("Final import counts - Users: {$totalUsers}");
            $this->info('All records have been successfully imported to Algolia');
            Log::info('Algolia import completed successfully');
        } catch (\Exception $e) {
            $this->error('Error importing records: ' . $e->getMessage());
            Log::error('Algolia import failed: ' . $e->getMessage());
        }
    }

    private function initializeAlgoliaClient()
    {
        $appId = config('services.algolia.app_id');
        $secret = config('services.algolia.secret');

        $this->info("Initializing Algolia client... AppID: {$appId}");
        $this->info("Initializing Algolia client... Secret: {$secret}");

        return SearchClient::create($appId, $secret);
    }
}
