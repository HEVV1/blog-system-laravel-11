<a href="{{$href}}"
    {{$attributes->merge(['class' =>
           'rounded-md
           border
           border-slate-300
           bg-white
           px-3
           py-2
           block
           text-center
           text-sm
           font-semibold
           text-black shadow-sm'])}}>
    {{$slot}}
</a>
