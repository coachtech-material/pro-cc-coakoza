@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-8">
    <h1 class="text-2xl font-bold text-center mb-6">会員登録</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名前</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">パスワード</label>
                <input type="password" name="password" id="password" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">パスワード（確認）</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">ロール</label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="role" value="student" {{ old('role', 'student') === 'student' ? 'checked' : '' }}
                            class="text-indigo-600 border-gray-300">
                        <span class="ml-2 text-sm text-gray-700">受講生</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="role" value="coach" {{ old('role') === 'coach' ? 'checked' : '' }}
                            class="text-indigo-600 border-gray-300">
                        <span class="ml-2 text-sm text-gray-700">コーチ</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                登録する
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            既にアカウントをお持ちの方は <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">ログイン</a>
        </p>
    </div>
</div>
@endsection
