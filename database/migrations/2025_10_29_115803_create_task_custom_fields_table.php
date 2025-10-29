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
        Schema::create('task_custom_fields', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('task_id');
        $table->string('field_key');
        $table->text('field_value')->nullable();
        $table->timestamps();
        $table->softDeletes();

        $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_custom_fields');
    }
};
