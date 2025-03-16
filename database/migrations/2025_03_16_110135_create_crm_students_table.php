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
        Schema::disableForeignKeyConstraints();

        Schema::create('crm_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->index();
            $table->string('email', 255)->index();
            $table->string('contact_number', 20)->index();
            $table->unsignedInteger('organization_id')->index()->nullable()->default('DEFAULT NULL');
            $table->foreign('organization_id')->references('id')->on('crm_organizations');
            $table->dateTime('created_at')->index()->useCurrent();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_students');
    }
};
