<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <title>Home</title>
</head>

<body>


    <!-- <form action="/postBlog" method="post" enctype="multipart/form-data" class="max-w-sm mx-auto">
        @csrf
        <div class="mb-5">
            <label class="block mb-2 text-sm font-medium text-gray-900" for=" file_input">Select Image</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none" id="file_input" type="file">
        </div>
        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 ">Blog Title</label>
            <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " placeholder="Blog Title" required />
        </div>
        <div class="mb-5">
            <label for="author" class="block mb-2 text-sm font-medium text-gray-900 ">Blog Author Name (Your Name)</label>
            <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
        </div>
        <div class="mb-5">
            <textarea name="content" id="summernote" placeholder="Enter Blog content"></textarea>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
    </form> -->



    <form action="/postBlog" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlFile1">Select Image</label>
            <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group">
            <label for="author">Blog Author</label>
            <input name="author" type="text" class="form-control" id="author" aria-describedby="emailHelp" placeholder="Author Name">
        </div>
        <div class="form-group">
            <label for="title">Blog Title</label>
            <input name="title" type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Blog Title">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea id="summernote" name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

    @if(session('success'))
    <script>
        alert('Blog id published successfully');
    </script>
    @endif

    @if(session('fail'))

    <script>
        alert('oops something went wrong , your blog did not get published');
    </script>

    @endif

    <!-- <script src="{{ asset('node_modules/flowbite/dist/flowbite.min.js') }}"></script> -->
</body>

</html>