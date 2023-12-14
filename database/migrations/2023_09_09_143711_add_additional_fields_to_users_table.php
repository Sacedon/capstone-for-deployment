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
            $table->string('mdc_id')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->enum('civil_status', ['single', 'married', 'separated', 'widowed'])->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->string('blood_type')->nullable();
            $table->string('sss_id_no')->nullable();
            $table->string('pag_ibig_id_no')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('tin_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
