<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationInstances extends Model
{
    /** @use HasFactory<\Database\Factories\EvaluationInstancesFactory> */
    use HasFactory;

    protected $table = 'evaluation_instances';

    protected $fillable = [
        'type',
        'fecha',
        'nota',
        'student_id',
        'subject_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->subject->teacher;
    }
}
