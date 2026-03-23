@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">コース編集: {{ $course->title }}</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('coach.courses.update', $course) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">カテゴリ</label>
                <select name="category_id" id="category_id" required class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">概要</label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">{{ old('description', $course->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-1">難易度</label>
                <select name="difficulty" id="difficulty" required class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    <option value="beginner" {{ old('difficulty', $course->difficulty) === 'beginner' ? 'selected' : '' }}>初級</option>
                    <option value="intermediate" {{ old('difficulty', $course->difficulty) === 'intermediate' ? 'selected' : '' }}>中級</option>
                    <option value="advanced" {{ old('difficulty', $course->difficulty) === 'advanced' ? 'selected' : '' }}>上級</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">ステータス</label>
                <select name="status" id="status" required class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    <option value="draft" {{ old('status', $course->status) === 'draft' ? 'selected' : '' }}>下書き</option>
                    <option value="published" {{ old('status', $course->status) === 'published' ? 'selected' : '' }}>公開</option>
                    <option value="archived" {{ old('status', $course->status) === 'archived' ? 'selected' : '' }}>アーカイブ</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">タグ</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tags', $course->tags->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600">
                            <span class="ml-1 text-sm">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">更新する</button>
                <a href="{{ route('coach.courses.index') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">キャンセル</a>
            </div>
        </form>
    </div>
</div>
@endsection
