@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('coach.courses.chapters.lessons.index', [$course, $chapter]) }}" class="text-indigo-600 hover:underline text-sm">&larr; レッスン一覧に戻る</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">レッスン作成: {{ $chapter->title }}</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('coach.courses.chapters.lessons.store', [$course, $chapter]) }}">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 mb-1">内容（Markdown）</label>
                <textarea name="body" id="body" rows="10" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border font-mono text-sm">{{ old('body') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600">
                    <span class="ml-2 text-sm text-gray-700">公開する</span>
                </label>
            </div>

            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">作成する</button>
        </form>
    </div>
</div>
@endsection
