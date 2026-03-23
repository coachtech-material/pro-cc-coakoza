<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(Course $course, Lesson $lesson)
    {
        $this->authorize('view', $course);

        $course->load('chapters.lessons');

        $progress = LessonProgress::where('user_id', auth()->id())
            ->where('lesson_id', $lesson->id)
            ->first();

        return view('courses.lessons.show', compact('course', 'lesson', 'progress'));
    }

    public function complete(Course $course, Lesson $lesson)
    {
        LessonProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $lesson->id,
            ],
            [
                'status' => 'completed',
                'completed_at' => now(),
            ]
        );

        return redirect()->route('courses.lessons.show', [$course, $lesson])
            ->with('success', 'レッスンを完了しました。');
    }
}
