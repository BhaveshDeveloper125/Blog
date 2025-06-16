<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>All Blogs</title>
</head>

<body>
    <x-menu />
    <div class="h-full w-full  p-4">
        <div class=""> Select Category </div>

        <form action="/filter" method="post">
            @csrf
            @if ($errors->any())
            <div class="p-4 bg-red-50 border-l-4 border-red-500">
                <ul class="mt-2 text-sm text-red-700 list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li class="text-xl">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <select name="filter[]" class="js-example-basic-multiple" multiple="multiple">
                @forelse($category as $i)
                <option value="{{ $i }}">{{ $i }}</option>
                @empty
                <h1>
                    empty
                </h1>
                @endforelse
            </select>

            <input type="submit" value="Search" class=" rounded-md shadow-lg shadow-black/50 p-2 ">
        </form>





        <div class="flex flex-1 flex-wrap gap-4">

            @forelse($blog as $i)
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
    </div>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
</body>

</html>