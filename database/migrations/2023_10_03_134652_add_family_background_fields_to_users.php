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
        Schema::table('users', function (Blueprint $table) {
            $table->text('spouse_surname')->nullable();
            $table->text('spouse_first_name')->nullable();
            $table->text('spouse_name_extension')->nullable();
            $table->text('spouse_middle_name')->nullable();
            $table->text('spouse_occupation')->nullable();
            $table->text('spouse_employer')->nullable();
            $table->text('spouse_business_address')->nullable();
            $table->text('spouse_telephone')->nullable();

             $table->text('father_surname')->nullable();
             $table->text('father_first_name')->nullable();
             $table->text('father_name_extension')->nullable();
             $table->text('father_middle_name')->nullable();

            $table->text('mother_maiden_surname')->nullable();
            $table->text('mother_first_name')->nullable();
            $table->text('mother_middle_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'spouse_surname',
                'spouse_first_name',
                'spouse_name_extension',
                'spouse_middle_name',
                'spouse_occupation',
                'spouse_employer',
                'spouse_business_address',
                'spouse_telephone',
                'father_surname',
                'father_first_name',
                'father_name_extension',
                'father_middle_name',
                'mother_maiden_surname',
                'mother_first_name',
                'mother_middle_name',
            ]);
        });
    }
};
