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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluator_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('rating_1a');
            $table->integer('rating_2a');
            $table->integer('rating_3a');
            $table->integer('rating_4a');
            $table->integer('rating_5a');
            $table->integer('rating_6a');
            $table->integer('rating_7a');
            $table->integer('rating_8a');
            $table->integer('rating_9a');
            $table->integer('rating_10a');
            $table->integer('rating_1b');
            $table->integer('rating_2b');
            $table->integer('rating_3b');
            $table->integer('rating_4b');
            $table->integer('rating_5b');
            $table->integer('rating_6b');
            $table->integer('rating_7b');
            $table->integer('rating_8b');
            $table->integer('rating_9b');
            $table->integer('rating_10b');
            $table->integer('rating_1c');
            $table->integer('rating_2c');
            $table->integer('rating_3c');
            $table->integer('rating_4c');
            $table->integer('rating_5c');
            $table->integer('rating_6c');
            $table->integer('rating_7c');
            $table->integer('rating_8c');
            $table->integer('rating_9c');
            $table->integer('rating_10c');
            $table->integer('rating_1d');
            $table->integer('rating_2d');
            $table->integer('rating_3d');
            $table->integer('rating_4d');
            $table->integer('rating_5d');
            $table->integer('rating_6d');
            $table->integer('rating_7d');
            $table->integer('rating_8d');
            $table->integer('rating_9d');
            $table->integer('rating_10d');
            $table->text('comments_a')->nullable();
            $table->text('comments_b')->nullable();
            $table->text('comments_c')->nullable();
            $table->text('comments_d')->nullable();
            $table->decimal('overall_rating', 5, 2)->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
