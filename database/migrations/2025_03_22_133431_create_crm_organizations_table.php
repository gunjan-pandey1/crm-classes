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

        Schema::create('crm_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->index();
            $table->unsignedInteger('student_count');
            $table->dateTime('created_at')->index()->useCurrent();
            $table->integer('updated_at');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_organizations');
    }
};
