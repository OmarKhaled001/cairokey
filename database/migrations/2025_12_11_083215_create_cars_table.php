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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable()->unique();
            $table->string('cover')->nullable();
            $table->json('images')->nullable();
            $table->decimal('price_per_day', 10, 2);
            $table->tinyInteger('rating')->default(0);
            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });

        Schema::create('car_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->json('tags')->nullable();

            $table->unique(['car_id', 'locale']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_translations');
        Schema::dropIfExists('cars');
    }
};
