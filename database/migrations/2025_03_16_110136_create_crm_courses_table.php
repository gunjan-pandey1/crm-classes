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

        Schema::create('crm_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku', 50)->index();
            $table->string('course_name', 255)->index();
            $table->decimal('rate', 10, 2)->default(0);
            $table->unsignedInteger('total_seats');
            $table->unsignedInteger('allotted_seats');
            $table->unsignedInteger('available_seats');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_courses');
    }
};
