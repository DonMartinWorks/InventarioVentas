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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('CASCADE');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('CASCADE');
            $table->foreignId('quote_id')->constrained('quotes')->onDelete('CASCADE');
            $table->integer('voucher_type');
            $table->string('series');
            $table->integer('correlative');
            $table->timestamp('date')->useCurrent();
            $table->decimal('total', 12, 2)->default(0);
            $table->string('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
