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
        Schema::create('crm_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assigned_counsellor', 100)->index();
            $table->string('subject', 255);
            $table->enum('source', [""]);
            $table->decimal('lead_value', 10, 2)->default(0);
            $table->enum('lead_type', [""]);
            $table->string('tag_name', 50)->index()->nullable()->default('DEFAULT NULL');
            $table->string('contact_student', 100)->index();
            $table->enum('stage', [""]);
            $table->enum('rotten_lead', [""])->index();
            $table->dateTime('expected_close_date')->index()->nullable()->default('DEFAULT NULL');
            $table->dateTime('created_at')->index()->useCurrent();
            $table->dateTime('updated_at')->index()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_leads');
    }
};
