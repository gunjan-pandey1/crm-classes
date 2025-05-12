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
        Schema::create('crm_models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name', 11)->index()->nullable();
            $table->string('model_slug', 11)->index()->nullable();
            $table->string('model_icon', 11)->index()->nullable();
            $table->integer('status')->nullable()->index()->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_models');
    }
};
