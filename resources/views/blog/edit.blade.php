<x-layout>
    <x-bread-crumbs class="mb-8"
                    :links="['Edit Blog' => route('blog.edit', ['blog' => $blog])]"/>
    <x-card>
        <form method="POST" action="{{route('blog.update', $blog)}}">
            @csrf
            @method('PUT')
            <div class="mb-8">
                <label for="title" class="mb-2 block text-sm font-medium text-slate-900">Title</label>
                <x-text-input
                    type="text"
                    name="title"
                    value="{{$blog->title ?? old('title')}}"
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
                    rows="10">{{$blog->body ?? old('body')}}</x-textarea-input>
                @error('body')
                <p class="error">{{$message}}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <x-button>Edit Blog</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
