<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Quiz;
use App\Models\User;

class SubmissionPolicy
{
    public function submit(User $user, Quiz $quiz, Course $course): bool
    {
        if ($user->role !== 'student') {
            return false;
        }

        return Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();
    }
}
