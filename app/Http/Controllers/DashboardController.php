<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'coach' => redirect()->route('coach.dashboard'),
            default => redirect()->route('courses.index'),
        };
    }
}
