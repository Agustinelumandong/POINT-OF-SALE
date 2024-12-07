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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName');
            $table->foreignId('product_categories_id')
                ->constrained('product_categories') // Explicit reference to table
                ->onDelete('cascade'); // Cascade on delete
            $table->foreignId('suppliers_id')
                ->constrained('suppliers') // Explicit reference to table
                ->onDelete('cascade'); // Cascade on delete
            $table->bigInteger('productCode')->unique(); // Product code as integer
            $table->string('productImage');
            $table->string('productStock');
            $table->string('buyingDate')->nullable();
            $table->string('expireDate')->nullable();
            $table->string('buyingPrice')->nullable();
            $table->string('sellingPrice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
