<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id', 'classs_id', 'year'   
    ];

    public function classs()
    {
        return $this->belongsTo(Classs::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
