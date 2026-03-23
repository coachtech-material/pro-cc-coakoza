<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    public function index(Course $course)
    {
        $this->authorize('update', $course);

        $enrollments = $course->enrollments()
            ->with('user')
            ->latest('enrolled_at')
            ->get();

        return view('coach.students.index', compact('course', 'enrollments'));
    }
}
