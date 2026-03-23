@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">コース作成</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('coach.courses.store') }}">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">カテゴリ</label>
                <select name="category_id" id="category_id" required class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">概要</label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-1">難易度</label>
                <select name="difficulty" id="difficulty" required class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    <option value="beginner" {{ old('difficulty') === 'beginner' ? 'selected' : '' }}>初級</option>
                    <option value="intermediate" {{ old('difficulty') === 'intermediate' ? 'selected' : '' }}>中級</option>
                    <option value="advanced" {{ old('difficulty') === 'advanced' ? 'selected' : '' }}>上級</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">ステータス</label>
                <select name="status" id="status" required class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>下書き</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>公開</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">タグ</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="flex items-center">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600">
                            <span class="ml-1 text-sm">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">作成する</button>
        </form>
    </div>
</div>
@endsection
