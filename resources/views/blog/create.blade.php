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

            <div class="mb-4">
                <label class="font-semibold text-slate-500 text-lg" for="categories">Add categories:</label>
                <select
                    class="form-control bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full"
                    name="categories[]"
                    id="categories"
                    multiple>
                    @foreach($allCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <x-button>Post</x-button>
            </div>
        </form>
    </x-card>
</x-layout>
