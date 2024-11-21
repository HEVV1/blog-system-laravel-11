<x-card class="mb-4">
    <div class="flex justify-between mb-4">
        <div class="text-sm font-medium flex items-center">
            <img class="w-6 mr-2" src="{{asset('icons/ic_user.png')}}" alt="">
            <span>{{$blog->user_id}}</span>
        </div>
        <span class="text-slate-400 text-xs">
            {{$blog->created_at->format('Y-M-d h:i A')}}
        </span>
    </div>
    <h2 class="font-semibold text-slate-500 text-xl mb-4">
        {{$blog->title}}
    </h2>
    <span class="text-sm text-slate-500">
        {!! nl2br(e($blog->body))  !!}
    </span>
</x-card>
