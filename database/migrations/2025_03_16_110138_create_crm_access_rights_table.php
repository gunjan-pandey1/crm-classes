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

        Schema::create('crm_access_rights', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('role', [""]);
            $table->string('module_name', 100);
            $table->boolean('can_view');
            $table->boolean('can_create');
            $table->boolean('can_edit');
            $table->boolean('can_delete');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
            $table->index(['role', 'module_name']);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_access_rights');
    }
};
