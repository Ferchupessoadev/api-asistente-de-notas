<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = "students";

    protected $fillable = [
        'name',
        'surname',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function grades()
    {
        return $this->hasMany(Grades::class, 'student_id');
    }
}
