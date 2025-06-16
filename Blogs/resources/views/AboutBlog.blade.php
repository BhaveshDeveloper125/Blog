<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-6">
        <!-- Blog Title -->
        <h1 class="text-4xl font-bold text-gray-800 text-center mb-6">Blog Title</h1>

        <!-- Metadata Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Blog Details</h2>
            <div class="text-gray-600 grid grid-cols-2 gap-4 text-lg">
                <p><span class="font-semibold">Author:</span> John Doe</p>
                <p><span class="font-semibold">Published On:</span> June 16, 2025</p>
                <p><span class="font-semibold">Reading Time:</span> 5 min</p>
                <p><span class="font-semibold">Category:</span> Tech</p>
                <p><span class="font-semibold">Tags:</span>
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded">Web Dev</span>
                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded">Tailwind CSS</span>
                </p>
            </div>
        </div>

        <!-- About Section -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">About This Blog</h2>
            <p class="text-gray-700 text-lg">
                Welcome to our blog! Here, we explore the latest trends in **web development**, share insightful **tutorials**,
                and discuss best practices in **design and coding**. Whether you're a beginner or an expert,
                there's something for everyone.
            </p>
        </div>
    </div>

</body>

</html>