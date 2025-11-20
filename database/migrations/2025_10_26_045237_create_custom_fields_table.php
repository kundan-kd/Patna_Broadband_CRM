<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('name_slug', 40)->nullable();
            $table->string('placeholder', 100)->nullable();
            $table->string('custom_field', 30)->nullable();
            $table->string('type',40)->nullable();
            $table->text('type_option')->nullable();
            $table->string('location',40)->nullable();
            $table->string('category',40)->nullable();
            $table->string('class',255)->nullable();
            $table->boolean('is_required')->default(false);
            $table->integer('position')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_fields');
    }
};
