@extends('layouts.app')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">カテゴリ管理</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">新規作成</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">名前</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">スラッグ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">コース数</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4">{{ $category->courses_count }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:underline text-sm">編集</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" onsubmit="return confirm('削除しますか？')">
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
</div>
@endsection
