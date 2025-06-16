<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <x-menu />

    <div class="max-w-4xl mx-auto p-6">

        <h1 class="text-4xl font-bold text-gray-800 text-center mb-6">Blog Title</h1>

        @forelse($about as $i)
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Blog Details</h2>
            <div class="text-gray-600 grid grid-cols-2 gap-4 text-lg">
                <p><span class="font-semibold">Author:</span> {{ $i->author }} </p>
                <p><span class="font-semibold">Published On:</span> {{ Carbon\Carbon::parse($i->created_at)->format('d-m-y') }}</p>
                <p><span class="font-semibold">Reading Time:</span> {{ $i->time }} min</p>
                <p><span class="font-semibold">Category:</span> {{ $i->category }} </p>
                <p><span class="font-semibold">Tags:</span>
                    @foreach(explode('#',$i->tags) as $j)
                    @if(!empty(trim($j)))
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded">#{{ trim($j) }}</span>
                    @endif
                    @endforeach

                </p>
            </div>
        </div>


        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">About This Blog</h2>
            <p class="text-gray-700 text-lg">
                {{ $i->description }}
            </p>
        </div>
        @empty
        <h1>This section is empty</h1>
        @endforelse

    </div>

</body>

</html>