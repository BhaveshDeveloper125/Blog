<?php

namespace App\Http\Controllers;

use App\Models\BlogData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublishBlogs extends Controller
{
    public function Blogs(Request $request)
    {

        // return response()->json($request->all());

        try {
            $validation = $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,webp',
                'author' => 'required|string',
                'title' => 'required|string',
                'content' => 'required',
                'tags' => 'required|string',
                'description' => 'required',
                'time' => 'required',
                'category' => 'required',
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $validation['image'] = "storage/$path";
            }

            $save = BlogData::create([
                'image' => $validation['image'],
                'author' => $validation['author'],
                'title' => $validation['title'],
                'content' => $validation['content'],
                'tags' => $validation['tags'],
                'description' => $validation['description'],
                'time' => $request->time,
                'category' => $validation['category'],
            ]);

            if ($save) {
                return redirect()->back()->with(['success' => true]);
            } else {
                return redirect()->back()->with(['fail' => true]);
            }
        } catch (Exception $e) {
            Log::info("Publishing Error : $e");
        }
    }

    public function GetBlogs()
    {

        $blogs = BlogData::all();

        $blogs = $blogs->sortByDesc('created_at');

        return view('AllBlogList', ['blog' => $blogs]);
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
}
