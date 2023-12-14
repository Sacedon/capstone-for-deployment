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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'employee', 'supervisor'])->default('employee');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('profile_picture')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('elementary_school')->nullable();
            $table->string('elementary_degree')->nullable();
            $table->date('elementary_attendance_from')->nullable();
            $table->date('elementary_attendance_to')->nullable();
            $table->string('elementary_highest_level')->nullable();
            $table->date('elementary_year_graduated')->nullable();
            $table->string('elementary_honors')->nullable();

            $table->string('secondary_school')->nullable();
            $table->string('secondary_degree')->nullable();
            $table->date('secondary_attendance_from')->nullable();
            $table->date('secondary_attendance_to')->nullable();
            $table->string('secondary_highest_level')->nullable();
            $table->date('secondary_year_graduated')->nullable();
            $table->string('secondary_honors')->nullable();

            $table->string('vocational_school')->nullable();
            $table->string('vocational_degree')->nullable();
            $table->date('vocational_attendance_from')->nullable();
            $table->date('vocational_attendance_to')->nullable();
            $table->string('vocational_highest_level')->nullable();
            $table->date('vocational_year_graduated')->nullable();
            $table->string('vocational_honors')->nullable();

            $table->string('college_school')->nullable();
            $table->string('college_degree')->nullable();
            $table->date('college_attendance_from')->nullable();
            $table->date('college_attendance_to')->nullable();
            $table->string('college_highest_level')->nullable();
            $table->date('college_year_graduated')->nullable();
            $table->string('college_honors')->nullable();

            $table->string('graduate_school')->nullable();
            $table->string('graduate_degree')->nullable();
            $table->date('graduate_attendance_from')->nullable();
            $table->date('graduate_attendance_to')->nullable();
            $table->string('graduate_highest_level')->nullable();
            $table->date('graduate_year_graduated')->nullable();
            $table->string('graduate_honors')->nullable();

            $table->string('signature')->nullable();
            $table->date('date')->nullable();
            $table->integer('total_vacation_leave_days')->default(0);
            $table->integer('total_sick_leave_days')->default(0);
            $table->integer('total_personal_leave_days')->default(0);
            $table->integer('total_fiesta_leave_days')->default(0);
            $table->integer('total_birthday_leave_days')->default(0);
            $table->integer('total_maternity_leave_days')->default(0);
            $table->integer('total_paternity_leave_days')->default(0);
            $table->integer('total_educational_leave_days')->default(0);

            $table->integer('used_vacation_leave_days')->default(0);
            $table->integer('used_sick_leave_days')->default(0);
            $table->integer('used_personal_leave_days')->default(0);
            $table->integer('used_fiesta_leave_days')->default(0);
            $table->integer('used_birthday_leave_days')->default(0);
            $table->integer('used_maternity_leave_days')->default(0);
            $table->integer('used_paternity_leave_days')->default(0);
            $table->integer('used_educational_leave_days')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
