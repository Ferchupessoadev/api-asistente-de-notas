<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subject';

    protected $fillable = [
        'name',
        'course_id',
        'teacher',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function students()
    {
        return $this->hasManyThrough(
            Student::class,  // Modelo final
            Course::class,   // Modelo intermedio
            'id',            // Foreign key en Course (clave primaria que conecta con Subject)
            'course_id',     // Foreign key en Student (clave foránea que conecta con Course)
            'course_id',     // Local key en Subject (clave foránea hacia Course)
            'id'             // Local key en Course
        );
    }
}
