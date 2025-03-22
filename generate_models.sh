#!/bin/bash

# Generate models with relationships
php artisan make:model Lead
php artisan make:model Quote
php artisan make:model Activity
php artisan make:model Organization
php artisan make:model Student
php artisan make:model Course
php artisan make:model User
php artisan make:model AccessRight

php artisan make:factory LeadFactory --model=Lead
php artisan make:factory QuoteFactory --model=Quote
php artisan make:factory ActivityFactory --model=Activity
php artisan make:factory OrganizationFactory --model=Organization
php artisan make:factory StudentFactory --model=Student
php artisan make:factory CourseFactory --model=Course
php artisan make:factory UserFactory --model=User
php artisan make:factory AccessRightFactory --model=AccessRight

php artisan make:seeder LeadSeeder
php artisan make:seeder QuoteSeeder
php artisan make:seeder ActivitySeeder
php artisan make:seeder OrganizationSeeder
php artisan make:seeder StudentSeeder
php artisan make:seeder CourseSeeder
php artisan make:seeder UserSeeder
php artisan make:seeder AccessRightSeeder
