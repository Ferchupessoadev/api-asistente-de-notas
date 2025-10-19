<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Course extends Model
{
    protected $table = "courses";

    public function students()
    {
        return $this->belongsTo(Student::class, 'courses_id');
    }
}
