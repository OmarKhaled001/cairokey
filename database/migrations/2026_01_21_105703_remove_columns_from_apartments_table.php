<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'location',
                'price_per_night',
                'rooms',
                'governorate',
                'rating',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->integer('rooms')->default(1);
            $table->string('governorate')->nullable();
            $table->tinyInteger('rating')->default(0);
        });
    }
};
