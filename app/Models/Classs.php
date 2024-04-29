<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classs extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'negaran'];


    // public function negaran()
    // {
    //     return $this->belongsTo(Teacher::class, 'negaran_id');
    // }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function classes()
    {
        return $this->hasMany(Student::class);
    }


    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
