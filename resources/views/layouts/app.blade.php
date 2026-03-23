<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'CoaKoza' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    {{-- ヘッダー --}}
    <header class="bg-white shadow fixed top-0 left-0 right-0 z-30 h-16">
        <div class="h-full px-6 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-indigo-600">CoaKoza</a>

            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-gray-500">{{ auth()->user()->name }}（{{ auth()->user()->role }}）</span>
                    <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-indigo-600 text-sm">プロフィール</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-600 text-sm">ログアウト</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">ログイン</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">会員登録</a>
                @endauth
            </div>
        </div>
    </header>

    @auth
    <div class="flex pt-16 min-h-screen">
        {{-- サイドバー --}}
        <aside class="w-60 bg-gray-900 text-gray-300 flex-shrink-0 fixed top-16 bottom-0 left-0 overflow-y-auto">
            <nav class="px-3 py-4 space-y-1">
                @if(auth()->user()->isStudent())
                    <a href="{{ route('courses.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('courses.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        コース一覧
                    </a>
                    <a href="{{ route('my-courses.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('my-courses.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/></svg>
                        マイコース
                    </a>

                @elseif(auth()->user()->isCoach())
                    <a href="{{ route('coach.dashboard') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('coach.dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        ダッシュボード
                    </a>
                    <a href="{{ route('coach.courses.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('coach.courses.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        コース管理
                    </a>

                @elseif(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        ダッシュボード
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        ユーザー管理
                    </a>
                    <a href="{{ route('admin.students.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.students.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        生徒一覧
                    </a>
                    <a href="{{ route('admin.courses.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.courses.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        コース管理
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                       class="flex items-center px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        カテゴリ管理
                    </a>
                @endif
            </nav>
        </aside>

        {{-- メインコンテンツ --}}
        <main class="flex-1 ml-60 py-6 px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @else
    {{-- 未認証時はサイドバーなし --}}
    <main class="pt-16 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
    @endauth
</body>
</html>
