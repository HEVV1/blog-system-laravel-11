<x-layout>
    <x-bread-crumbs class="mb-8"
                    :links="['Login' => route('auth.create')]"/>
    <x-card class="py-8 px-16">
        <form action="{{route('auth.store')}}" method="POST">
            <h1 class="my-10 text-center text-4xl font-medium text-slate-600">Sign in to your account</h1>
            @csrf
            <div class="mb-8">
                <label for="email" class="mb-2 block text-sm font-medium text-slate-900">E-mail</label>
                <x-text-input name="email"/>
            </div>

            <div class="mb-8">
                <label for="password" class="mb-2 block text-sm font-medium text-slate-900">Password</label>
                <x-text-input type="password" name="password"/>
            </div>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="rounded-sm border border-slate-400">
                    <label for="remember">Remember me</label>
                </div>
                <div>
                    <a href="#" class="text-indigo-600 hover:underline">Forget the password?</a>
                </div>
            </div>

            <x-button class="w-full bg-green">Login</x-button>
        </form>
    </x-card>
</x-layout>
