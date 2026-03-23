@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">{{ $course->title }}</h1>
                <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                    <span>by {{ $course->user->name }}</span>
                    <span class="px-2 py-1 rounded text-xs
                        {{ $course->difficulty === 'beginner' ? 'bg-green-100 text-green-800' : ($course->difficulty === 'intermediate' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                        {{ $course->difficulty === 'beginner' ? '初級' : ($course->difficulty === 'intermediate' ? '中級' : '上級') }}
                    </span>
                    <span>{{ $course->category->name ?? '' }}</span>
                </div>
                @if($course->tags->isNotEmpty())
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($course->tags as $tag)
                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            @if(auth()->user()->isStudent())
                @if($enrollment)
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm">受講中</span>
                @else
                    <form method="POST" action="{{ route('courses.enroll', $course) }}">
                        @csrf
                        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">受講登録</button>
                    </form>
                @endif
            @endif
        </div>

        <p class="text-gray-700">{{ $course->description }}</p>
    </div>

    <div class="space-y-4">
        @foreach($course->chapters->sortBy('order') as $chapter)
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="text-lg font-semibold mb-3">{{ $chapter->order }}. {{ $chapter->title }}</h2>
                <ul class="space-y-2">
                    @foreach($chapter->lessons->where('is_published', true)->sortBy('order') as $lesson)
                        <li class="flex items-center justify-between py-2 px-3 hover:bg-gray-50 rounded">
                            <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="text-indigo-600 hover:underline">
                                {{ $lesson->order }}. {{ $lesson->title }}
                            </a>
                            @if($lesson->quiz)
                                <a href="{{ route('courses.quizzes.show', [$course, $lesson->quiz]) }}" class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded">小テスト</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
