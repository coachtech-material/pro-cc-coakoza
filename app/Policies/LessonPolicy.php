<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    public function manage(User $user, Lesson $lesson): bool
    {
        return $user->id === $lesson->chapter->course->user_id;
    }
}
