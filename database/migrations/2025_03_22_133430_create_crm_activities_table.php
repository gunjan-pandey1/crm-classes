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

        Schema::create('crm_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('crm_users');
            $table->string('title', 255);
            $table->boolean('is_done');
            $table->text('comment')->nullable();
            $table->string('lead', 255)->index()->nullable();
            $table->string('type', 50)->index()->nullable();
            $table->dateTime('schedule_from')->index();
            $table->dateTime('schedule_to')->index();
            $table->dateTime('created_at')->index()->useCurrent();
        });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_activities');
    }
};
