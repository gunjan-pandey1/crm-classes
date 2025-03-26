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
            $table->foreignId('user_id')->constrained('crm_users')->nullable();
            $table->integer('leads')->nullable();
            $table->integer('quotes')->nullable();
            $table->integer('activities')->nullable();
            $table->integer('organization')->nullable();
            $table->integer('students')->nullable();
            $table->integer('courses')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
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
