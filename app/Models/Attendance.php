<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'year', 'total_year', 'attendance_type', 'student_id', 'classs_id', 'present', 'absent', 'sick', 'leave',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classes()
    {
        return $this->belongsTo(Classs::class);
    }
}
