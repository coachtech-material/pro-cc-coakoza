@extends('layouts.app')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">コース管理</h1>
        <a href="{{ route('coach.courses.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">新規作成</a>
    </div>

    @if($courses->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500">まだコースがありません。</p>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">タイトル</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ステータス</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">チャプター数</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">受講者数</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($courses as $course)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $course->title }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $course->status === 'published' ? 'bg-green-100 text-green-800' : ($course->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $course->status === 'published' ? '公開' : ($course->status === 'draft' ? '下書き' : 'アーカイブ') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $course->chapters_count }}</td>
                            <td class="px-6 py-4">{{ $course->enrollments_count }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('coach.courses.edit', $course) }}" class="text-indigo-600 hover:underline text-sm">編集</a>
                                <a href="{{ route('coach.courses.chapters.index', $course) }}" class="text-indigo-600 hover:underline text-sm">チャプター</a>
                                <a href="{{ route('coach.courses.students.index', $course) }}" class="text-indigo-600 hover:underline text-sm">受講者</a>
                                <form method="POST" action="{{ route('coach.courses.destroy', $course) }}" class="inline" onsubmit="return confirm('本当に削除しますか？')">
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
    @endif
</div>
@endsection
