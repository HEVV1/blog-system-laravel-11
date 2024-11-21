<x-layout>
    <x-bread-crumbs class="mb-2"
        :links="['Blogs' => route('blog.index'), $blog->title => '#']"/>
    <x-blog-card :blog="$blog">
    </x-blog-card>
</x-layout>
