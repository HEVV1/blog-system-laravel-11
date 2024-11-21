<nav {{$attributes}}>
    <ul class="flex space-x-2 text-slate-500 font-semibold">
        <li>
            <a href="/">Home</a>
        </li>
        @foreach($links as $label => $link)
            <li>&rarr;</li>
            <li>
                <a href="{{$link}}">
                    {{$label}}
                </a>
            </li>
        @endforeach
    </ul>
</nav>
