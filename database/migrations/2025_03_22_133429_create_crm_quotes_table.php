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
            $table->string('subject', 255);
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('adjustment', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->dateTime('expired_at')->index();
            $table->dateTime('created_at')->index()->useCurrent();
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
