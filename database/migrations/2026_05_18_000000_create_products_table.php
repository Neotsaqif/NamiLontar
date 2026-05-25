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
            $table->string('slug')->unique();
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->string('category');
            $table->decimal('rating', 2, 1)->default(5.0);
            $table->integer('reviews')->default(0);
            $table->text('description');
            $table->string('image');
            $table->text('ingredients')->nullable();
            $table->text('storage')->nullable();
            $table->text('artisan_note')->nullable();
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
