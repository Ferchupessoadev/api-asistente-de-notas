<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    /** @use HasFactory<\Database\Factories\GradesFactory> */
    use HasFactory;

    protected $fillable = [
        'nota',
        'evaluation_instances_id',
        'student_id',
    ];

    public function evaluationInstance()
    {
        return $this->belongsTo(EvaluationInstances::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
