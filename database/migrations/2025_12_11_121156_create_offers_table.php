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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable()->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->string('cover')->nullable();
            $table->json('items');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('active')->default(true);
            $table->boolean('featured')->default(false);

            $table->timestamps();
        });

        Schema::create('offer_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name');
            $table->text('description')->nullable();

            $table->unique(['offer_id', 'locale']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_translations');
        Schema::dropIfExists('offers');
    }
};
