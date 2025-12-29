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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->string('location');
            $table->decimal('price_per_night', 10, 2);

            $table->string('cover')->nullable();
            $table->json('images')->nullable();
            $table->json('tags')->nullable();

            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->text('description')->nullable();
            $table->tinyInteger('rating')->default(0);

            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
