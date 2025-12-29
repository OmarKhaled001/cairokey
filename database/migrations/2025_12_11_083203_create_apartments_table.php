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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();

            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->string('location')->nullable();
            $table->integer('rooms')->default(1);
            $table->decimal('price_per_night', 10, 2);

            $table->text('video_url')->nullable();
            $table->string('cover')->nullable();
            $table->json('images')->nullable();
            $table->json('tags')->nullable();

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
        Schema::dropIfExists('apartments');
    }
};
