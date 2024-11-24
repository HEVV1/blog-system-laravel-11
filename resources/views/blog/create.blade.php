<x-layout>
    <x-bread-crumbs class="mb-8"
                    :links="['Create Blog' => route('blog.create')]"/>
    <x-card>
        <form method="POST" action="{{route('blog.store')}}">
            @csrf
            <div class="mb-8">
                <label for="title" class="mb-2 block text-sm font-medium text-slate-900">Title</label>
                <x-text-input
                    type="text"
                    name="title"
                    value="{{old('title')}}"
                    placeholder="Blog Title">
                </x-text-input>
                @error('title')
                <p class="error">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-8">
                <label for="body" class="mb-2 block text-sm font-medium text-slate-900">Body</label>
                <x-textarea-input
                    type="text"
                    name="body"
                    placeholder="Blog Title"
                    rows="10">{{old('body')}}</x-textarea-input>
                @error('body')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-button>Post</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
