<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('products', function (Blueprint $table) {

        if (!Schema::hasColumn('products', 'product_weight')) {
            $table->double('product_weight')->nullable()->after('stock');
        }

    });
}


public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('product_weight');
    });
}
};
