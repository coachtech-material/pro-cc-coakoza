@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('coach.courses.chapters.index', $course) }}" class="text-indigo-600 hover:underline text-sm">&larr; チャプター一覧に戻る</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">小テスト管理: {{ $lesson->title }}</h1>

    @if(!$quiz)
        <div class="bg-white rounded-lg shadow p-6">
            <p class="text-gray-500 mb-4">この小テストはまだ作成されていません。</p>
            <form method="POST" action="{{ route('coach.courses.lessons.quizzes.store', [$course, $lesson]) }}">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                </div>
                <div class="mb-4">
                    <label for="passing_score" class="block text-sm font-medium text-gray-700 mb-1">合格点（%）</label>
                    <input type="number" name="passing_score" id="passing_score" value="{{ old('passing_score', 70) }}" min="0" max="100" required
                        class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                </div>
                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">小テストを作成</button>
            </form>
        </div>
    @else
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold">{{ $quiz->title }}</h2>
                <form method="POST" action="{{ route('coach.courses.lessons.quizzes.destroy', [$course, $lesson]) }}" onsubmit="return confirm('小テストを削除しますか？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline text-sm">削除</button>
                </form>
            </div>

            <form method="POST" action="{{ route('coach.courses.lessons.quizzes.update', [$course, $lesson]) }}" class="mb-4">
                @csrf
                @method('PUT')
                <div class="flex gap-4 items-end">
                    <div class="flex-1">
                        <label for="quiz_title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                        <input type="text" name="title" id="quiz_title" value="{{ $quiz->title }}" required
                            class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    </div>
                    <div>
                        <label for="quiz_passing_score" class="block text-sm font-medium text-gray-700 mb-1">合格点（%）</label>
                        <input type="number" name="passing_score" id="quiz_passing_score" value="{{ $quiz->passing_score }}" min="0" max="100" required
                            class="w-32 border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    </div>
                    <button type="submit" class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700">更新</button>
                </div>
            </form>
        </div>

        <h3 class="text-lg font-semibold mb-4">問題一覧（{{ $quiz->questions->count() }}問）</h3>

        @foreach($quiz->questions->sortBy('order') as $question)
            <div class="bg-white rounded-lg shadow p-4 mb-3">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="font-medium">問{{ $question->order }}. {{ $question->body }}</p>
                        <ul class="mt-2 space-y-1">
                            @foreach($question->options as $option)
                                <li class="text-sm {{ $option->is_correct ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                    {{ $option->is_correct ? '○' : '　' }} {{ $option->body }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <form method="POST" action="{{ route('coach.courses.lessons.quizzes.questions.destroy', [$course, $lesson, $question]) }}" onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">削除</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">問題を追加</h3>
            <form method="POST" action="{{ route('coach.courses.lessons.quizzes.questions.store', [$course, $lesson]) }}">
                @csrf

                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-1">問題文</label>
                    <textarea name="body" id="body" rows="2" required
                        class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">{{ old('body') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">選択肢（正解にチェック）</label>
                    @for($i = 0; $i < 4; $i++)
                        <div class="flex items-center gap-2 mb-2">
                            <input type="radio" name="correct_option" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }}
                                class="text-indigo-600 border-gray-300">
                            <input type="text" name="options[{{ $i }}][body]" value="{{ old("options.{$i}.body") }}" required
                                class="flex-1 border-gray-300 rounded-md shadow-sm px-3 py-2 border" placeholder="選択肢{{ $i + 1 }}">
                        </div>
                    @endfor
                </div>

                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">追加する</button>
            </form>
        </div>
    @endif
</div>
@endsection
