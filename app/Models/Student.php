<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Student extends Model
{
    protected $table = "students";

    public function course()
    {
        return $this->belongsTo(Course::class, 'courses_id');
    }
}
