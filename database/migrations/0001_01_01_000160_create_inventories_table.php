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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->morphs('inventoryable'); // Polymorphic fields: inventoryable_type, inventoryable_id
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->bigInteger('quantity')->default(0);
            $table->timestamps();

            $table->unique(['inventoryable_type', 'inventoryable_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
