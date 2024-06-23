<?php

use App\Models\Classs;
use App\Models\Province;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('first_name_en');
            $table->string('last_name');
            $table->string('last_name_en');
            $table->string('father_name');
            $table->string('father_name_en');
            $table->string('grand_father');
            $table->string('image')->nullable();
            $table->date('dob');
            // $table->foreignIdFor(Classs::class)->constrained();
            $table->string('base_number');
            $table->string('tazkira_number');
            // $table->foreignId('current_residence')->references('id')->on('provinces');
            $table->foreignId('main_residence')->references('id')->on('provinces');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
