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
        Schema::create('sub_categories', function (Blueprint $table) {

            $table->id();

            // Category Relation
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->onDelete('cascade');

            // Sub Category Info
            $table->string('name');

            $table->text('description');

            $table->string('image');

            // Status
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('1 = Publish, 0 = Unpublish');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};