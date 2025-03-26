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
            $table->foreignId('quotes_id')->constrained('crm_quotes')->nullable();
            $table->foreignId('organization_id')->constrained('crm_organizations')->nullable();
            $table->foreignId('courses_id')->constrained('crm_courses')->nullable();
            $table->string('name', 255)->index()->nullable();
            $table->string('email', 255)->index()->nullable();
            $table->string('contact_number', 20)->index()->nullable();
            $table->integer('status')->nullable()->index()->default(1);
            $table->dateTime('created_at')->index()->useCurrent();
            $table->dateTime('updated_at')->index()->useCurrent()->useCurrentOnUpdate();
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
