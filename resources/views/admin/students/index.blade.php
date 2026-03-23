@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-6">生徒一覧</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">名前</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">メール</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">受講コース数</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">登録日</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($students as $student)
                    <tr>
                        <td class="px-6 py-4">{{ $student->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $student->email }}</td>
                        <td class="px-6 py-4">{{ $student->enrollments->count() }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $student->created_at->format('Y/m/d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $students->links() }}
    </div>
</div>
@endsection
