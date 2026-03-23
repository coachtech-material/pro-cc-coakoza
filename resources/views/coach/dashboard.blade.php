@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-6">コーチ ダッシュボード</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-indigo-600">{{ $courseCount }}</p>
            <p class="text-gray-500 mt-1">コース数</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $publishedCount }}</p>
            <p class="text-gray-500 mt-1">公開中</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-3xl font-bold text-blue-600">{{ $totalStudents }}</p>
            <p class="text-gray-500 mt-1">受講生数</p>
        </div>
    </div>

    <div class="flex space-x-4">
        <a href="{{ route('coach.courses.index') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">コース管理へ</a>
        <a href="{{ route('coach.courses.create') }}" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">新規コース作成</a>
    </div>
</div>
@endsection
