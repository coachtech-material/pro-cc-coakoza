@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('coach.courses.chapters.index', $course) }}" class="text-indigo-600 hover:underline text-sm">&larr; チャプター一覧に戻る</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">チャプター編集: {{ $chapter->title }}</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('coach.courses.chapters.update', [$course, $chapter]) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title', $chapter->title) }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">更新する</button>
                <a href="{{ route('coach.courses.chapters.index', $course) }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">キャンセル</a>
            </div>
        </form>
    </div>
</div>
@endsection
