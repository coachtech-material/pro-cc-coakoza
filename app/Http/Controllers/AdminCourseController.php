<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('user', 'category');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $courses = $query->latest()->paginate(20);

        return view('admin.courses.index', compact('courses'));
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'コースを削除しました。');
    }
}
