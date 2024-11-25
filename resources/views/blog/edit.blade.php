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

            <div class="mt-4 mb-4">
                <span class="font-semibold text-slate-500 text-xl">
                    Category:
                </span>
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($blog->categories as $category)
                        <span class="rounded border py-2 px-2 bg-slate-200">{{$category->name}}</span>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <x-button>Edit Blog</x-button>
            </div>
        </form>

        <div class="mb-4">
            <form method="POST" action="{{route('blog.categories.remove', $blog)}}">
                @csrf
                @method('DELETE')
                <label class="font-semibold text-slate-500 text-lg" for="remove_categories">Remove categories</label>
                <select name="categories[]" id="remove_categories"
                        class="form-control bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full"
                        multiple>
                    @foreach($blog->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="flex justify-end mt-4">
                    <x-button>Remove</x-button>
                </div>
            </form>
        </div>

        <div class="mb-4">
            <form method="POST" action="{{route('blog.categories.add', $blog)}}">
                @csrf
                <label class="font-semibold text-slate-500 text-lg" for="categories">Add categories:</label>
                <select
                    class="form-control bg-gray-100 border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full"
                    name="categories[]"
                    id="categories"
                    multiple>
                    @foreach($allCategories as $category)
                        @if(!$blog->categories->contains($category))
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="flex justify-end mt-4">
                    <x-button>Add</x-button>
                </div>
            </form>
        </div>
    </x-card>
</x-layout>
