@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-6">マイコース</h1>

    @if($enrollments->isEmpty())
        <div class="bg-white rounded-lg shadow p-12 text-center">
            <p class="text-gray-500 mb-4">まだコースに登録していません。</p>
            <a href="{{ route('courses.index') }}" class="text-indigo-600 hover:underline">コース一覧を見る</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($enrollments as $enrollment)
                @php
                    $course = $enrollment->course;
                    $progressRate = $course->getProgressRate(auth()->id());
                @endphp
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold">
                                <a href="{{ route('courses.show', $course) }}" class="text-gray-900 hover:text-indigo-600">{{ $course->title }}</a>
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                by {{ $course->user->name ?? '不明' }}
                                <span class="ml-2">受講開始: {{ $enrollment->enrolled_at->format('Y/m/d') }}</span>
                                <span class="ml-2 px-2 py-0.5 rounded text-xs
                                    {{ $enrollment->status === 'active' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $enrollment->status === 'active' ? '受講中' : '完了' }}
                                </span>
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-indigo-600">{{ $progressRate }}%</p>
                            <p class="text-xs text-gray-500">進捗率</p>
                        </div>
                    </div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $progressRate }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
