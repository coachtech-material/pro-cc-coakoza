@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('courses.show', $course) }}" class="text-indigo-600 hover:underline text-sm">&larr; {{ $course->title }} に戻る</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h1 class="text-2xl font-bold mb-4">{{ $lesson->title }}</h1>

        <div class="prose max-w-none">
            {!! nl2br(e($lesson->body)) !!}
        </div>
    </div>

    @if(auth()->user()->isStudent())
        <div class="flex items-center justify-between bg-white rounded-lg shadow p-4">
            <div>
                @if($progress && $progress->status === 'completed')
                    <span class="text-green-600 font-medium">完了済み</span>
                @else
                    <span class="text-gray-500">未完了</span>
                @endif
            </div>

            @if(!$progress || $progress->status !== 'completed')
                <form method="POST" action="{{ route('courses.lessons.complete', [$course, $lesson]) }}">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">レッスンを完了する</button>
                </form>
            @endif
        </div>
    @endif

    @if($lesson->quiz)
        <div class="mt-4 bg-white rounded-lg shadow p-4">
            <h3 class="font-semibold mb-2">小テスト: {{ $lesson->quiz->title }}</h3>
            <a href="{{ route('courses.quizzes.show', [$course, $lesson->quiz]) }}" class="text-indigo-600 hover:underline">受験する</a>
        </div>
    @endif

    {{-- Navigation --}}
    <div class="mt-6 flex justify-between">
        @php
            $allLessons = $course->chapters->sortBy('order')->flatMap(fn($c) => $c->lessons->where('is_published', true)->sortBy('order'));
            $currentIndex = $allLessons->search(fn($l) => $l->id === $lesson->id);
            $prevLesson = $currentIndex > 0 ? $allLessons->values()[$currentIndex - 1] : null;
            $nextLesson = $currentIndex < $allLessons->count() - 1 ? $allLessons->values()[$currentIndex + 1] : null;
        @endphp

        @if($prevLesson)
            <a href="{{ route('courses.lessons.show', [$course, $prevLesson]) }}" class="text-indigo-600 hover:underline">&larr; {{ $prevLesson->title }}</a>
        @else
            <span></span>
        @endif

        @if($nextLesson)
            <a href="{{ route('courses.lessons.show', [$course, $nextLesson]) }}" class="text-indigo-600 hover:underline">{{ $nextLesson->title }} &rarr;</a>
        @endif
    </div>
</div>
@endsection
