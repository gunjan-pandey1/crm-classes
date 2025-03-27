<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Algolia\AlgoliaSearch\SearchClient;
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
            $client = $this->initializeAlgoliaClient();
            $indices = $this->initializeIndices($client);
            $this->configureIndices($indices);
            $this->importData($indices);

            $this->info('All records have been successfully imported to Algolia');
            Log::info('Algolia import completed successfully');
        } catch (\Exception $e) {
            $this->error('Error importing records: ' . $e->getMessage());
            Log::error('Algolia import failed: ' . $e->getMessage());
        }
    }

    private function initializeAlgoliaClient()
    {
        $this->info('Initializing Algolia client...');
        Log::info('Initializing Algolia client');
        
        return SearchClient::create(
            config('services.algolia.app_id'),
            config('services.algolia.secret')
        );
    }

    private function initializeIndices($client)
    {
        $this->info('Initializing indices...');
        Log::info('Initializing Algolia indices');

        return [
            'users' => $client->initIndex('users'),
            'leads' => $client->initIndex('leads'),
            'courses' => $client->initIndex('courses')
        ];
    }

    private function configureIndices($indices)
    {
        $this->info('Configuring index settings...');
        Log::info('Configuring Algolia index settings');

        $indices['users']->setSettings([
            'searchableAttributes' => [
                'name',
                'email',
                'phone'
            ]
        ]);
    }

    private function importData($indices)
    {
        $this->info('Starting data import...');
        Log::info('Beginning data import to Algolia');

        // Import users
        $totalUsers = 0;
        CrmUser::chunk(100, function($users) use ($indices, &$totalUsers) {
            $records = $users->map(function($user) {
                return [
                    'objectID' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ];
            })->toArray();
            
            $indices['users']->saveObjects($records);
            $totalUsers += count($records);
            
            $this->info("Imported {$totalUsers} users so far...");
            Log::info("Batch import: {$totalUsers} users processed");
        });

        $this->info("Total records imported - Users: {$totalUsers}");
        Log::info("Final import counts - Users: {$totalUsers}");
    }
}
