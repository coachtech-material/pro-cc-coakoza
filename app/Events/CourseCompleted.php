<?php

namespace App\Events;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * コースの全レッスン完了時に発火するイベント
 *
 * 将来的に完了証明書の発行やコーチへの通知等を追加しやすくするため、
 * Event/Listener パターンで実装。
 */
class CourseCompleted
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Enrollment $enrollment,
        public User $user,
        public Course $course,
    ) {}
}
