<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Policies\EnrollmentPolicy;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Course $course)
    {
        $policy = new EnrollmentPolicy();
        if (!$policy->enroll(auth()->user(), $course)) {
            abort(403, 'この操作は許可されていません。');
        }

        Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'status' => 'active',
            'enrolled_at' => now(),
        ]);

        return redirect()->route('courses.show', $course)
            ->with('success', 'コースに登録しました。');
    }
}
