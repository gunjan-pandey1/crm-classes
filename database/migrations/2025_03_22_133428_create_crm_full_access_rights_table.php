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

        Schema::create('crm_full_access_rights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('crm_users');
            $table->integer('leads');
            $table->integer('quotes');
            $table->integer('activities');
            $table->integer('organization');
            $table->integer('students');
            $table->integer('courses');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->index('user_id');
        });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_full_access_rights');
    }
};
