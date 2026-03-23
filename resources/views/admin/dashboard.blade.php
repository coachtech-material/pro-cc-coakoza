@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-6">管理者ダッシュボード</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
            <p class="text-gray-500 mt-1">総ユーザー数</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $totalStudents }}</p>
            <p class="text-gray-500 mt-1">受講生数</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-blue-600">{{ $totalCoaches }}</p>
            <p class="text-gray-500 mt-1">コーチ数</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-purple-600">{{ $totalCourses }}</p>
            <p class="text-gray-500 mt-1">総コース数</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-teal-600">{{ $publishedCourses }}</p>
            <p class="text-gray-500 mt-1">公開コース</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $totalEnrollments }}</p>
            <p class="text-gray-500 mt-1">総受講登録数</p>
        </div>
    </div>
</div>
@endsection
