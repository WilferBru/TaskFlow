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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id('id_task');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->enum('priority', ['alta', 'media', 'baja'])->default('media');
            $table->text('description')->nullable();
            $table->jsonb('metadata')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();

            // Llaver foraneas
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('state_id')->references('id_state')->on('state_tasks')->onDelete('cascade');
            $table->foreign('category_id')->references('id_category')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
