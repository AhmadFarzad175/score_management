<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'image',
        'dob',
        'classs_id',
        'base_number',
        'tazkira_number',
        'current_residence',
        'main_residence',
        'status'
    ];

    public function classs()
    {
        return $this->belongsTo(Classs::class);
    }


    public function currentResidence()
    {
        return $this->belongsTo(Province::class, 'current_residence', 'id');
    }

    public function mainResidence()
    {
        return $this->belongsTo(Province::class, 'main_residence', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
