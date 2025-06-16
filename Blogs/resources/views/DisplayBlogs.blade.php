<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Display Blog</title>
</head>

<body class="">
    <x-menu />
    @forelse($readBlog as $i)
    <div class="h-fit w-full p-4 flex justify-center items-center">
        <div class="h-full w-[50%] rounded-md p-2  shadow-2xl shadow-black/50 overflow-auto">
            <img src="{{ url($i->image) }}" alt="blog image" class="h-[50%] w-full rounded-md object-cover">
            <div class="p-2 font-bold">{{$i->author}} : {{ Carbon\Carbon::parse($i->created_at)->format('d-m-y') }} </div>
            <div class="h-fit w-full p-4  overflow-auto">{!! $i->content !!}</div>
            <br><br>
            <div class=" flex flex-wrap gap-4">

                @foreach(explode('#',$i->tags) as $j)
                @if(!empty(trim($j)))
                <span class="px-2 py-1 bg-green-100 text-green-600 rounded shadow-sm shadow-black/50">#{{ trim($j) }}</span>
                @endif
                @endforeach

            </div>
            <br><br><br><br>
            <div class="flex justify-end">
                <a href="/aboutblog/{{ $i->id }}" class="bg-purple-500 text-white text-right p-4 ">About This Blog</a>
            </div>
        </div>
    </div>
    @empty
    <h1>This section is empty</h1>
    @endforelse
</body>

</html>