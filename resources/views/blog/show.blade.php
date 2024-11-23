<x-layout>
    <x-bread-crumbs class="mb-2"
                    :links="['Blogs' => route('blog.index'), $blog->title => '#']"/>
    <x-blog-card :blog="$blog">

    </x-blog-card>
    <div class="w-full flex justify-end gap-4">
        <x-link-button href="{{route('blog.edit', ['blog' => $blog])}}">Edit</x-link-button>
        <form method="POST" action="{{route('blog.destroy', ['blog' => $blog])}}">
            @csrf
            @method('DELETE')
            <x-button>Delete</x-button>
        </form>
    </div>
</x-layout>
