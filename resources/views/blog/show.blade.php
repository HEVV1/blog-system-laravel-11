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
    @if(count($blog->comments) > 0)
        <span class="font-semibold text-slate-500 text-xl">Comments</span>
    @endif
    @foreach($blog->comments as $comment)
        <x-card class="mb-2 mt-2">
            <div class="flex justify-between mb-4">
                <div class="text-sm font-medium flex items-center">
                    <img class="w-6 mr-2" src="{{asset('icons/ic_user.png')}}" alt="">
                    <span>{{$comment->user->name}}</span>
                </div>
                <span class="text-slate-400 text-xs">
            {{$comment->created_at->format('Y-M-d h:i A')}}
        </span>
            </div>
            <span class="text-sm text-slate-500">
            {!! nl2br(e($comment->content))  !!}
        </span>
        </x-card>
        @if (Auth::id() === $comment->user_id)
            <div class="mb-8">
                <form method="POST"
                      action="{{route('blog.comments.remove', ['comment' => $comment, 'blog' => $blog])}}">
                    @csrf
                    @method('DELETE')
                    <div class="w-full flex justify-end">
                        <x-button>Delete Comment</x-button>
                    </div>
                </form>
            </div>
        @endif
    @endforeach
    @if(Auth::check())
        <div class="mb-10 mt-10">
            <form method="POST" action="{{route('blog.comments.add', ['blog' => $blog])}}">
                @csrf
                <label class="font-semibold text-slate-500 text-lg" for="comment">Leave a comment</label>
                <x-text-area-input
                    type="text"
                    placeholder="Place your comment here..."
                    name="comment"
                    id="comment"
                    rows="10">
                    {{old('comment')}}
                </x-text-area-input>
                @error('comment')
                <p class="error">{{$message}}</p>
                @enderror
                <div class="w-full flex justify-end">
                    <x-button>Add a comment</x-button>
                </div>
            </form>
        </div>
    @endif
</x-layout>
