@extends('layouts.app')

@section('content')
<div>
    <div class="mb-4">
        <a href="{{ route('coach.courses.index') }}" class="text-indigo-600 hover:underline text-sm">&larr; コース管理に戻る</a>
    </div>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">チャプター管理: {{ $course->title }}</h1>
        <a href="{{ route('coach.courses.chapters.create', $course) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">新規チャプター</a>
    </div>

    @if($chapters->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500">チャプターがありません。</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($chapters as $chapter)
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="font-semibold">{{ $chapter->order }}. {{ $chapter->title }}</h2>
                            <p class="text-sm text-gray-500">{{ $chapter->lessons->count() }} レッスン</p>
                        </div>
                        <div class="space-x-2">
                            <a href="{{ route('coach.courses.chapters.lessons.index', [$course, $chapter]) }}" class="text-indigo-600 hover:underline text-sm">レッスン管理</a>
                            <a href="{{ route('coach.courses.chapters.edit', [$course, $chapter]) }}" class="text-indigo-600 hover:underline text-sm">編集</a>
                            <form method="POST" action="{{ route('coach.courses.chapters.destroy', [$course, $chapter]) }}" class="inline" onsubmit="return confirm('削除しますか？')">
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
