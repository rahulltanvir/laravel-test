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

        $table->foreignId('category_id')
      ->constrained('categories')
      ->onDelete('cascade');

$table->foreignId('subcategory_id')
      ->constrained('sub_categories')
      ->onDelete('cascade');

        $table->foreignId('brand_id')->nullable();
        $table->foreignId('unit_id')->nullable();

        $table->string('name');
        $table->string('slug')->nullable();

        $table->string('sku')->nullable();
        $table->string('product_code')->nullable();

        $table->integer('stock')->default(0);

        $table->double('regular_price');
        $table->double('sale_price')->nullable();
        $table->integer('discount')->default(0);

        $table->text('short_description')->nullable();
        $table->longText('long_description')->nullable();

        $table->string('thumbnail')->nullable();

        $table->boolean('featured')->default(0);
        $table->boolean('status')->default(1);

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
