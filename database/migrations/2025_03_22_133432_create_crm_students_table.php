<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::disableForeignKeyConstraints();

        Schema::create('crm_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotes_id')->constrained('crm_quotes');
            $table->foreignId('organization_id')->constrained('crm_organizations');
            $table->foreignId('courses_id')->constrained('crm_courses');
            $table->string('name', 255)->index();
            $table->string('email', 255)->index();
            $table->string('contact_number', 20)->index();
            $table->dateTime('created_at')->index()->useCurrent();
            $table->dateTime('updated_at');
        });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_students');
    }
};
