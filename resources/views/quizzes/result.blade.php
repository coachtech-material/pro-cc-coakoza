@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('courses.show', $course) }}" class="text-indigo-600 hover:underline text-sm">&larr; {{ $course->title }} に戻る</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-2">{{ $quiz->title }} - 結果</h1>

        <div class="text-center py-6">
            <p class="text-5xl font-bold {{ $submission->score >= $quiz->passing_score ? 'text-green-600' : 'text-red-600' }}">
                {{ $submission->score }}%
            </p>
            <p class="mt-2 text-lg {{ $submission->score >= $quiz->passing_score ? 'text-green-600' : 'text-red-600' }}">
                {{ $submission->score >= $quiz->passing_score ? '合格' : '不合格' }}
            </p>
            <p class="text-sm text-gray-500 mt-1">合格点: {{ $quiz->passing_score }}%</p>
        </div>

        <hr class="my-6">

        @php
            $userAnswers = collect($submission->answers);
        @endphp

        @foreach($quiz->questions->sortBy('order') as $index => $question)
            @php
                $userAnswer = $userAnswers->firstWhere('question_id', $question->id);
                $selectedOptionId = $userAnswer['option_id'] ?? null;
                $correctOption = $question->options->firstWhere('is_correct', true);
                $isCorrect = $selectedOptionId && $correctOption && $selectedOptionId == $correctOption->id;
            @endphp
            <div class="mb-4 p-4 rounded {{ $isCorrect ? 'bg-green-50' : 'bg-red-50' }}">
                <p class="font-medium mb-2">
                    <span class="{{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">{{ $isCorrect ? '○' : '×' }}</span>
                    問{{ $index + 1 }}. {{ $question->body }}
                </p>
                @foreach($question->options as $option)
                    <p class="ml-4 text-sm {{ $option->is_correct ? 'text-green-700 font-medium' : 'text-gray-600' }}">
                        {{ $option->id == $selectedOptionId ? '▶ ' : '　' }}{{ $option->body }}
                        @if($option->is_correct) (正解) @endif
                    </p>
                @endforeach
            </div>
        @endforeach

        <div class="mt-6 flex space-x-4">
            <a href="{{ route('courses.quizzes.show', [$course, $quiz]) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">再受験する</a>
            <a href="{{ route('courses.show', $course) }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">コースに戻る</a>
        </div>
    </div>
</div>
@endsection
