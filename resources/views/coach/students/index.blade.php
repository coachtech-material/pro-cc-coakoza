@extends('layouts.app')

@section('content')
<div>
    <div class="mb-4">
        <a href="{{ route('coach.courses.index') }}" class="text-indigo-600 hover:underline text-sm">&larr; コース管理に戻る</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">受講者一覧: {{ $course->title }}</h1>

    @if($enrollments->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500">受講者はまだいません。</p>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">名前</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">メール</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ステータス</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">受講開始日</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">進捗率</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($enrollments as $enrollment)
                        <tr>
                            <td class="px-6 py-4">{{ $enrollment->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $enrollment->user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $enrollment->status === 'active' ? 'bg-blue-100 text-blue-800' : ($enrollment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $enrollment->status === 'active' ? '受講中' : ($enrollment->status === 'completed' ? '完了' : 'キャンセル') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $enrollment->enrolled_at->format('Y/m/d') }}</td>
                            <td class="px-6 py-4">{{ $course->getProgressRate($enrollment->user_id) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
