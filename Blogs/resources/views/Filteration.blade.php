<x-menu />
{{ $cat }}

<div class="flex flex-1 flex-wrap gap-4">

    @forelse($cat as $i)
    <a href="/blogs/{{ $i->id }}" class="h-80 w-80 rounded-md shadow-lg shadow-black/50 p-2 overflow-hidden">
        <img src="{{ $i->image }}" alt="blog image" class="h-40 w-full rounded-md object-cover">
        <div class="w-full p-4 flex justify-around"><span class="font-semibold">{{ $i->author }}</span> : <span class="font-semibold">{{ Carbon\Carbon::parse($i->created_at)->format('d-m-y') }}</span> </div>
        <p class="line-clamp-4">
            {!! $i->content !!}
        </p>
    </a>
    @empty
    <h1> This field is empty </h1>
    @endforelse





</div>