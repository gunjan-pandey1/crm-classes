<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\CrmModels;

class CrmModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            ['model_name' => 'Dashboard', 'model_slug' => 'dashboard', 'model_icon' => 'LayoutGrid', 'status' => 1],
            ['model_name' => 'Leads', 'model_slug' => 'leads', 'model_icon' => 'Headset', 'status' => 1],
            ['model_name' => 'Quotes', 'model_slug' => 'quotes', 'model_icon' => 'Quote', 'status' => 1],
            ['model_name' => 'Activities', 'model_slug' => 'activities', 'model_icon' => 'SquareActivity', 'status' => 1],
            ['model_name' => 'Contacts', 'model_slug' => 'contacts', 'model_icon' => 'Contact', 'status' => 1],
            ['model_name' => 'Courses', 'model_slug' => 'courses', 'model_icon' => 'Book', 'status' => 1],
            ['model_name' => 'Settings', 'model_slug' => 'settings', 'model_icon' => 'Settings', 'status' => 1],
        ];

        foreach ($models as $model) {
            CrmModels::create($model);
        }
    }
}
