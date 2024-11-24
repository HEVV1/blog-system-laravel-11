<x-layout>
    <x-bread-crumbs class="mb-8"
                    :links="['Login' => route('login.form')]"/>
    <x-card class="py-8 px-16">
        <form action="{{route('login')}}"
              method="POST">
            <h1 class="my-10 text-center text-4xl font-medium text-slate-600">Create new account</h1>
            @csrf

            <div class="mb-8">
                <label for="name"
                       class="mb-2 block text-sm font-medium text-slate-900">E-mail</label>
                <x-text-input
                    name="email"
                    type="email"
                    value="{{old('email')}}"
                    required/>
                @error('email')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password"
                       class="mb-2 block text-sm font-medium text-slate-900">Password</label>
                <x-text-input
                    type="password"
                    name="password"
                    required/>
                @error('password')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div>
                    <a href="#" class="text-indigo-600 hover:underline">Forgot the password?</a>
                </div>
            </div>

            <x-button class="w-full bg-green">Log In</x-button>
        </form>
    </x-card>
</x-layout>
