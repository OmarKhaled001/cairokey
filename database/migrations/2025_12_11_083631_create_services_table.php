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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('icon')->nullable();
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
    public function down()
    {
        Schema::dropIfExists('services');
    }
};
