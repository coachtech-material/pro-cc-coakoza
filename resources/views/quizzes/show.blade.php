@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('courses.show', $course) }}" class="text-indigo-600 hover:underline text-sm">&larr; {{ $course->title }} に戻る</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-2">{{ $quiz->title }}</h1>
        <p class="text-sm text-gray-500 mb-6">合格点: {{ $quiz->passing_score }}%</p>

        @if($quiz->questions->isEmpty())
            <p class="text-gray-500">この小テストにはまだ問題がありません。</p>
        @else
            <form method="POST" action="{{ route('courses.quizzes.submit', [$course, $quiz]) }}">
                @csrf

                @foreach($quiz->questions->sortBy('order') as $index => $question)
                    <div class="mb-6 p-4 bg-gray-50 rounded">
                        <p class="font-medium mb-3">問{{ $index + 1 }}. {{ $question->body }}</p>
                        @foreach($question->options as $option)
                            <label class="flex items-center mb-2 cursor-pointer">
                                <input type="radio" name="answers[{{ $index }}][option_id]" value="{{ $option->id }}"
                                    class="text-indigo-600 border-gray-300">
                                <input type="hidden" name="answers[{{ $index }}][question_id]" value="{{ $question->id }}">
                                <span class="ml-2">{{ $option->body }}</span>
                            </label>
                        @endforeach
                    </div>
                @endforeach

                <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 font-medium">
                    回答を送信する
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
