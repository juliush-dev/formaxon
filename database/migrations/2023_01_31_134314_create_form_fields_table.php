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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            /* $table->string('order_in_form'); */
            $table->string('label');
            $table->boolean('value_required')->default(false);
            $table->boolean('field_visible_by_target')->nullable();
            $table->boolean('value_editable_by_target')->nullable();
            $table->boolean('value_is_unique')->nullable();
            $table->boolean('value_is_reference')->nullable();
            $table->boolean('value_is_a_set')->nullable();
            $table->string('referenced_field_id')->nullable();
            $table->string('default_value_ref_id')->nullable();
            $table->string('default_value_ref_ids')->nullable();
            $table->string('value_options')->nullable();
            $table->string('default_value')->nullable();
            $table->string('default_value_set')->nullable();
            $table->string('accepted_file_types')->nullable();
            $table->integer('value_min_length')->nullable();
            $table->integer('value_max_length')->nullable();
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
        Schema::dropIfExists('form_fields');
    }
};