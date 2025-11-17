<?php

namespace App\Policies;

use App\Models\EvaluationInstances;
use App\Models\Subject;
use App\Models\User;

class EvaluationInstancesPolicy
{
    protected $model = EvaluationInstances::class;

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, EvaluationInstances $evaluationInstances): bool
    {
        return $user->id === $evaluationInstances->subject->teacher_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, EvaluationInstances $evaluationInstances): bool
    {
        return $user->id === $evaluationInstances->subject->teacher_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, EvaluationInstances $evaluationInstances): bool
    {
        return $user->id === $evaluationInstances->subject->teacher_id;
    }

    public function viewInstancesBySubjectAndStudent(User $user, Subject $subject): bool
    {
        return $user->id === $subject->teacher_id;
    }
}
