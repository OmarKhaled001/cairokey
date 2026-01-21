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
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'location',
                'governorate',
                'price_per_night',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('governorate')->nullable();
            $table->decimal('price_per_night', 10, 2);
        });
    }
};
