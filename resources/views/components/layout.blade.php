<!doctype html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/ts/app.ts'])
</head>
<body class="mx-auto mt-10 max-w-2xl text-slate-700">
<nav class="mb-8 flex justify-between text-lg font-medium">
    <ul class="flex space-x-2">
        <li>
            <a href="{{route('blog.index')}}"></a>
        </li>
    </ul>
    <ul class="flex space-x-2 items-center">
        @auth
            <li class="mr-4">
                User: {{auth()->user()->name ?? 'Anonymous'}}
            </li>
            <li>
                <form method="POST" action="{{route('auth.destroy')}}">
                    @csrf
                    @method('DELETE')
                    <x-button>Logout</x-button>
                </form>
            </li>
        @else
            @if(!request()->routeIs('auth.create'))
                <li>
                    <x-link-button href="{{route('auth.create')}}">Log In</x-link-button>
                </li>
            @else
                <li>
                    <x-link-button href="{{route('blog.index')}}">Sign In</x-link-button>
                </li>
            @endif

        @endauth
    </ul>
</nav>
{{$slot}}
</body>
</html>
