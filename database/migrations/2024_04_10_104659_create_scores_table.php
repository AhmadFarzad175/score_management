<?php

use App\Models\Classs;
use App\Models\Student;
use App\Models\Subject;
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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained();
            $table->foreignIdFor(Subject::class)->constrained();
            $table->foreignIdFor(Classs::class)->constrained();
            $table->integer('mark');
            $table->boolean('exam_type');
            $table->integer('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
