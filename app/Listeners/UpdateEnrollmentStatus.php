<?php

namespace App\Listeners;

use App\Events\CourseCompleted;

/**
 * コース完了時に Enrollment のステータスを更新するリスナー
 */
class UpdateEnrollmentStatus
{
    public function handle(CourseCompleted $event): void
    {
        $event->enrollment->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }
}
