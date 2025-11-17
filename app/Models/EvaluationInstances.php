<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationInstances extends Model
{
    use HasFactory;

    protected $table = 'evaluation_instances';

    protected $fillable = [
        'type',
        'description',
        'fecha',
        'subject_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grades()
    {
        return $this->hasMany(Grades::class, 'evaluation_instances_id');
    }

    public function student()
    {
        return $this->grades->student;
    }
}
