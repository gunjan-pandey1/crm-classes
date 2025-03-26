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

        Schema::create('crm_quotes', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 255)->nullable();
            $table->decimal('subtotal', 10, 2)->default(0)->nullable();
            $table->decimal('discount', 10, 2)->default(0)->nullable();
            $table->decimal('tax', 10, 2)->default(0)->nullable();
            $table->decimal('adjustment', 10, 2)->default(0)->nullable();
            $table->decimal('grand_total', 10, 2)->default(0)->nullable();
            $table->dateTime('expired_at')->index()->nullable();
            $table->integer('status')->nullable()->index()->default(1);
            $table->dateTime('created_at')->index()->useCurrent();
            $table->dateTime('updated_at')->index()->useCurrent()->useCurrentOnUpdate();
        });

        // Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_quotes');
    }
};
