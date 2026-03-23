@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-6">コース一覧</h1>

    <form method="GET" action="{{ route('courses.index') }}" class="mb-6 bg-white p-4 rounded-lg shadow flex flex-wrap gap-4 items-end">
        <div class="flex-1 min-w-[200px]">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">キーワード</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border" placeholder="検索...">
        </div>
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">カテゴリ</label>
            <select name="category" id="category" class="border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                <option value="">すべて</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-1">難易度</label>
            <select name="difficulty" id="difficulty" class="border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                <option value="">すべて</option>
                <option value="beginner" {{ request('difficulty') === 'beginner' ? 'selected' : '' }}>初級</option>
                <option value="intermediate" {{ request('difficulty') === 'intermediate' ? 'selected' : '' }}>中級</option>
                <option value="advanced" {{ request('difficulty') === 'advanced' ? 'selected' : '' }}>上級</option>
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">検索</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium px-2 py-1 rounded
                            {{ $course->difficulty === 'beginner' ? 'bg-green-100 text-green-800' : ($course->difficulty === 'intermediate' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ $course->difficulty === 'beginner' ? '初級' : ($course->difficulty === 'intermediate' ? '中級' : '上級') }}
                        </span>
                        <span class="text-xs text-gray-500">{{ $course->category->name ?? '' }}</span>
                    </div>
                    <h2 class="text-lg font-semibold mb-2">
                        <a href="{{ route('courses.show', $course) }}" class="text-gray-900 hover:text-indigo-600">{{ $course->title }}</a>
                    </h2>
                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                    <div class="text-xs text-gray-500">
                        <span>by {{ $course->user->name ?? '不明' }}</span>
                        <span class="ml-2">{{ $course->chapters->count() }} チャプター</span>
                        <span class="ml-2">{{ $course->enrollments->count() }}名受講中</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-500 py-12">
                コースが見つかりませんでした。
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $courses->withQueryString()->links() }}
    </div>
</div>
@endsection
