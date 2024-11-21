<x-layout>
    <x-bread-crumbs class="mb-8"
                    :links="['Blogs' => route('blog.index')]"/>
    <h1 class="uppercase font-semibold text-4xl mb-6 text-center text-slate-700">Blog posts</h1>
    <div class="mb-4">
        <form method="GET" action="{{route('blog.index')}}">
            <div class="flex">
                <x-text-input
                    name="search"
                    value="{{request('search')}}"
                    placeholder="Search for a blog">
                </x-text-input>

                <x-button class="ml-4 px-4">Search</x-button>
            </div>
        </form>
    </div>
    <x-link-button href="{{route('blog.create')}}">Create a new blog</x-link-button>
    @foreach($blogs as $blog)
        <a href="{{route('blog.show', $blog)}}">
            <x-blog-card :blog="$blog" class="hover:bg-slate-100 ">
            </x-blog-card>
        </a>
    @endforeach
</x-layout>
