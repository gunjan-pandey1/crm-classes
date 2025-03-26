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

        Schema::create('crm_access_rights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('crm_users')->nullable();
            $table->string('module_name', 100)->nullable();
            $table->integer('can_view')->nullable();
            $table->integer('can_create')->nullable();
            $table->integer('can_edit')->nullable();
            $table->integer('can_delete')->nullable();
            $table->integer('status')->nullable()->index()->default(1);
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_access_rights');
    }
};
