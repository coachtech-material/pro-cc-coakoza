@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-8">
    <h1 class="text-2xl font-bold text-center mb-6">ログイン</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">パスワード</label>
                <input type="password" name="password" id="password" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 border">
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
                    <span class="ml-2 text-sm text-gray-600">ログイン状態を保持する</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                ログイン
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-600">
            アカウントをお持ちでない方は <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">会員登録</a>
        </p>
    </div>
</div>
@endsection
