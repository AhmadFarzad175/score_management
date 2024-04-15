<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'year','total_educational_year','student_id','present','absent','sick','leave',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
