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
            $table->string('slug')->nullable()->unique();
            $table->string('cover')->nullable();
            $table->json('images')->nullable();
            $table->tinyInteger('rating')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);

            $table->timestamps();
        });

        Schema::create('hotel_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->json('tags')->nullable();

            $table->unique(['hotel_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_translations');
        Schema::dropIfExists('hotels');
    }
};
