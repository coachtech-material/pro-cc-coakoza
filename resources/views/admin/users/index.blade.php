@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-6">ユーザー管理</h1>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 bg-white p-4 rounded-lg shadow flex gap-4 items-end">
        <div class="flex-1">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">検索</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border" placeholder="名前・メールアドレス">
        </div>
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">ロール</label>
            <select name="role" id="role" class="border-gray-300 rounded-md shadow-sm px-3 py-2 border">
                <option value="">すべて</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>admin</option>
                <option value="coach" {{ request('role') === 'coach' ? 'selected' : '' }}>coach</option>
                <option value="student" {{ request('role') === 'student' ? 'selected' : '' }}>student</option>
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">検索</button>
    </form>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">名前</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">メール</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ロール</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">登録日</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-sm">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <form method="POST" action="{{ route('admin.users.updateRole', $user) }}" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <select name="role" class="text-sm border-gray-300 rounded px-2 py-1 border">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                    <option value="coach" {{ $user->role === 'coach' ? 'selected' : '' }}>coach</option>
                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>student</option>
                                </select>
                                <button type="submit" class="text-indigo-600 hover:underline text-sm">変更</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('Y/m/d') }}</td>
                        <td class="px-6 py-4 text-sm">-</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->withQueryString()->links() }}
    </div>
</div>
@endsection
