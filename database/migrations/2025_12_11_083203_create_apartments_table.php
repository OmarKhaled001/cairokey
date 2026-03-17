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
            $table->string('slug')->nullable()->unique();
            $table->decimal('min_price', 10, 2)->nullable();
            $table->decimal('max_price', 10, 2)->nullable();
            $table->text('video_url')->nullable();
            $table->string('cover')->nullable();
            $table->json('images')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);

            $table->timestamps();
        });

        Schema::create('apartment_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('city')->nullable();
            $table->json('tags')->nullable();
            $table->unique(['apartment_id', 'locale']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_translations');
        Schema::dropIfExists('apartments');
    }
};
