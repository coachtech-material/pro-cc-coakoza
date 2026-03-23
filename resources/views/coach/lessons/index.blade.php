@extends('layouts.app')

@section('content')
<div>
    <div class="mb-4">
        <a href="{{ route('coach.courses.chapters.index', $course) }}" class="text-indigo-600 hover:underline text-sm">&larr; チャプター一覧に戻る</a>
    </div>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">レッスン管理: {{ $chapter->title }}</h1>
        <a href="{{ route('coach.courses.chapters.lessons.create', [$course, $chapter]) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">新規レッスン</a>
    </div>

    @if($lessons->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500">レッスンがありません。</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($lessons as $lesson)
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold">
                                {{ $lesson->order }}. {{ $lesson->title }}
                                @if(!$lesson->is_published)
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded ml-2">非公開</span>
                                @endif
                            </h2>
                        </div>
                        <div class="space-x-2">
                            <a href="{{ route('coach.courses.lessons.quizzes.index', [$course, $lesson]) }}" class="text-indigo-600 hover:underline text-sm">小テスト</a>
                            <a href="{{ route('coach.courses.chapters.lessons.edit', [$course, $chapter, $lesson]) }}" class="text-indigo-600 hover:underline text-sm">編集</a>
                            <form method="POST" action="{{ route('coach.courses.chapters.lessons.destroy', [$course, $chapter, $lesson]) }}" class="inline" onsubmit="return confirm('削除しますか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
