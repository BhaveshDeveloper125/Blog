<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>

    <!-- Bootstrap & jQuery -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mt-4">
        <form action="{{ route('submit.blog') }}" method="post" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Select Image</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" placeholder="Author Name">
            </div>

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" placeholder="Blog Title">
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea id="summernote" name="content" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Tags (use # symbol)</label>
                <textarea name="tags" class="form-control" rows="2"></textarea>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Read Time (in minutes)</label>
                <input type="number" name="time" class="form-control">
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Publish Blog</button>
            <a href="/allblogs" class="btn btn-primary">View All Blogs</a>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 200,
                callbacks: {
                    onImageUpload: function (files) {
                        let data = new FormData();
                        data.append("file", files[0]);
                        $.ajax({
                            url: "/upload-image",
                            method: "POST",
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                            data: data,
                            contentType: false,
                            processData: false,
                            success: function (url) {
                                $('#summernote').summernote('insertImage', url);
                            },
                            error: function () {
                                alert("Image upload failed.");
                            }
                        });
                    }
                }
            });
        });
    </script>

    @if(session('success'))
        <script>alert('Blog published successfully');</script>
    @endif

    @if(session('fail'))
        <script>alert('Oops! Something went wrong, blog not published');</script>
    @endif
</body>
</html>

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