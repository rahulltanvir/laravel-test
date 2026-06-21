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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

$table->string('name');
$table->string('phone');
$table->string('email')->nullable();

$table->string('division');
$table->string('district');
$table->string('upazila');
$table->text('address');

$table->text('note')->nullable();

$table->string('payment_method');

$table->double('subtotal');
$table->double('tax');
$table->double('shipping_cost');
$table->double('grand_total');

$table->string('status')->default('pending');

$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
