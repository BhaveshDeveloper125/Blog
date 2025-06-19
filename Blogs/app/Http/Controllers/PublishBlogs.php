<?php

namespace App\Http\Controllers;

use App\Models\BlogData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PublishBlogs extends Controller
{

    public function Blogs(Request $request)
    {
       try {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg,png,webp',
            'author' => 'required|string',
            'title' => 'required|string',
            'content' => 'required',
            'tags' => 'required|string',
            'description' => 'required',
            'time' => 'required|numeric',
            'category' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $path = $request->file('image')->store('images', 'public');

        BlogData::create([
            'image' => "storage/$path",
            'author' => $request->author,
            'title' => $request->title,
            'content' => $request->content,
            'tags' => $request->tags,
            'description' => $request->description,
            'time' => $request->time,
            'category' => $request->category,
        ]);

        return redirect()->back()->with(['success' => true]);

    } catch (\Exception $e) {
        Log::error("Blog submission failed: " . $e->getMessage());
        return redirect()->back()->with(['fail' => true]);
    }
    }

    public function uploadImage(Request $request)
{
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('images', 'public');
        return asset('storage/' . $path);
    }

    return response()->json(['error' => 'Upload failed'], 400);
}



    public function GetBlogs()
    {

        $category = BlogData::distinct()->inRandomOrder()->limit(10)->pluck('category');

        $blogs = BlogData::all();

        $blogs = $blogs->sortByDesc('created_at');

        return view('AllBlogList', ['blog' => $blogs, 'category' => $category]);
        // return response()->json($blogs);
    }

    public function SpecificBlog($id)
    {
        $specific_blog = BlogData::where('id', $id)->get();

        return view('DisplayBlogs', ['readBlog' => $specific_blog]);
        // dd($specific_blog);
    }

    public function AboutBlog($id)
    {
        $about = BlogData::where('id', $id)->get();
        return view('AboutBlog', ['about' => $about]);
    }

    public function Filteration(Request $request)
    {

        $validation = $request->validate([
            'filter' => 'required|'
        ]);


        try {
            $filter_array = is_array($validation['filter']) ? $validation['filter'] : [$validation['filter']];
            $category = BlogData::whereIn('category', $filter_array)->get();

            return view('Filteration', ['cat' => $category]);
        } catch (Exception $e) {
            Log::info('Category Fetching Search Error : ' . $e);
        }
    }
}
