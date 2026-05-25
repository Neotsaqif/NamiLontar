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
        Schema::table('products', function (Blueprint $table) {
            // Whether this product uses size options on product page
            $table->boolean('has_size_options')->default(false)->after('artisan_note');
            // JSON: [{"label":"250gr","unit":"gram"},{"label":"500gr","unit":"gram"},...]
            $table->json('size_options')->nullable()->after('has_size_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['has_size_options', 'size_options']);
        });
    }
};
