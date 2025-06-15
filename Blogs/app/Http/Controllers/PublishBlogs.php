<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublishBlogs extends Controller
{
    public function Blogs(Request $request)
    {
        return response()->json($request->all());
    }
}
