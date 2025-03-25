<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Algolia\AlgoliaSearch\SearchClient;
use App\Models\Lead;
use App\Models\Course;
use App\Models\CrmUser;

class AlgoliaDbInsert extends Command
{
    protected $signature = 'app:algolia-db-insert';
    protected $description = 'Insert bulk database records into Algolia search index';

    public function handle()
    {
        $client = SearchClient::create(
            config('services.algolia.app_id'),
            config('services.algolia.secret')
        );

        // Initialize indices
        $usersIndex = $client->initIndex('users');
        $leadsIndex = $client->initIndex('leads');
        $coursesIndex = $client->initIndex('courses');

        // Configure index settings (optional)
        $usersIndex->setSettings([
            'searchableAttributes' => [
                'name',
                'email',
                'phone'
            ]
        ]);

        try {
            // Batch import users
            $users = CrmUser::chunk(100, function($users) use ($usersIndex) {
                $records = $users->map(function($user) {
                    return [
                        'objectID' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        // Add more fields as needed
                    ];
                })->toArray();
                
                $usersIndex->saveObjects($records);
                $this->info('Imported ' . count($records) . ' users');
            });

            // Batch import leads
            $leads = Lead::chunk(100, function($leads) use ($leadsIndex) {
                $records = $leads->map(function($lead) {
                    return [
                        'objectID' => $lead->id,
                        'name' => $lead->name,
                        'email' => $lead->email,
                        'status' => $lead->status,
                        // Add more fields as needed
                    ];
                })->toArray();
                
                $leadsIndex->saveObjects($records);
                $this->info('Imported ' . count($records) . ' leads');
            });

            // Batch import courses
            $courses = Course::chunk(100, function($courses) use ($coursesIndex) {
                $records = $courses->map(function($course) {
                    return [
                        'objectID' => $course->id,
                        'title' => $course->title,
                        'description' => $course->description,
                        // Add more fields as needed
                    ];
                })->toArray();
                
                $coursesIndex->saveObjects($records);
                $this->info('Imported ' . count($records) . ' courses');
            });

            $this->info('All records have been successfully imported to Algolia');
        } catch (\Exception $e) {
            $this->error('Error importing records: ' . $e->getMessage());
        }
    }
}
