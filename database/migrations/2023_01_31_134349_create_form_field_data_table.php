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
        Schema::create('form_field_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_field_id')->constrained()->cascadeOnDelete();
            $table->foreignId('participant_id')->nullable();
            $table->integer('visitor_id')->nullable();
            $table->text('value');
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
        Schema::dropIfExists('form_field_data');
    }
};