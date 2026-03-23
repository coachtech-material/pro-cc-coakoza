@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 hover:underline text-sm">&larr; カテゴリ一覧に戻る</a>
    </div>

    <h1 class="text-2xl font-bold mb-6">カテゴリ作成</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">カテゴリ名</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm px-3 py-2 border">
            </div>

            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">作成する</button>
        </form>
    </div>
</div>
@endsection
