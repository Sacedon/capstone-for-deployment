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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('reason');
            $table->string('educational_reason');
            $table->string('other_reason');
            $table->text('rejection_reason')->nullable();
            $table->string('leave_type');
            $table->enum('status', ['pending_supervisor', 'recommend_for_approval', 'approved', 'rejected', 'ended']);
            $table->boolean('supervisor_approval')->default(false);
            $table->boolean('admin_approval')->default(false);
            $table->integer('number_of_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
