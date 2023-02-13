<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->enum('target', ['visitor', 'company']);
            $table->boolean('field_visible_by_target')->default(false);
            $table->text('description')->nullable();
            $table->string('location', 255);
            $table->string('thumbnail')->nullable();
            $table->date('at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
