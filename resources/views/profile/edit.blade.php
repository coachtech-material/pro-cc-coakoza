@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">プロフィール編集</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名前</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                <input type="email" id="email" value="{{ $user->email }}" disabled
                    class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">自己紹介</label>
                <textarea name="bio" id="bio" rows="4"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="avatar_url" class="block text-sm font-medium text-gray-700 mb-1">アバター URL</label>
                <input type="url" name="avatar_url" id="avatar_url" value="{{ old('avatar_url', $user->avatar_url) }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                更新する
            </button>
        </form>
    </div>
</div>
@endsection
