<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('CASCADE');
            $table->foreignId('purchase_order_id')->nullable()->constrained('purchase_orders')->onDelete('SET NULL');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('CASCADE');
            $table->integer('voucher_type');
            $table->string('series');
            $table->integer('correlative');
            $table->timestamp('date')->useCurrent();
            $table->decimal('total', 12, 2)->default(0);
            $table->string('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
