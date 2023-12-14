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
            $table->string('residential_house_no')->nullable();
            $table->string('residential_street')->nullable();
            $table->string('residential_subdivision')->nullable();
            $table->string('residential_barangay')->nullable();
            $table->string('residential_city')->nullable();
            $table->string('residential_province')->nullable();
            $table->string('residential_zip_code')->nullable();
            $table->string('permanent_house_no')->nullable();
            $table->string('permanent_street')->nullable();
            $table->string('permanent_subdivision')->nullable();
            $table->string('permanent_barangay')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_province')->nullable();
            $table->string('permanent_zip_code')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('messenger_account')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'residential_house_no',
                'residential_street',
                'residential_subdivision',
                'residential_barangay',
                'residential_city',
                'residential_province',
                'residential_zip_code',
                'permanent_house_no',
                'permanent_street',
                'permanent_subdivision',
                'permanent_barangay',
                'permanent_city',
                'permanent_province',
                'permanent_zip_code',
                'telephone_number',
                'mobile_number',
                'messenger_account',
            ]);
        });
    }
};
