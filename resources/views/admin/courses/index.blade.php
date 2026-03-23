@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-6">コース管理</h1>

    <form method="GET" action="{{ route('admin.courses.index') }}" class="mb-6 bg-white p-4 rounded-lg shadow flex gap-4 items-end">
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">ステータス</label>
            <select name="status" id="status" class="border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                <option value="">すべて</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>下書き</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>公開</option>
                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>アーカイブ</option>
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">絞り込み</button>
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">タイトル</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">コーチ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">カテゴリ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ステータス</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($courses as $course)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $course->title }}</td>
                        <td class="px-6 py-4 text-sm">{{ $course->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm">{{ $course->category->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $course->status === 'published' ? 'bg-green-100 text-green-800' : ($course->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $course->status === 'published' ? '公開' : ($course->status === 'draft' ? '下書き' : 'アーカイブ') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline" onsubmit="return confirm('削除しますか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $courses->withQueryString()->links() }}
    </div>
</div>
@endsection
