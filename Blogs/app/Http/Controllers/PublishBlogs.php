<?php

namespace App\Http\Controllers;

use App\Models\BlogData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


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

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
            } else {
                $path = null;
            }

            $save = BlogData::create([
                'image' => $path ? "storage/$path" : null,
                'author' => $request->author,
                'title' => $request->title,
                'content' => $request->content,
                'tags' => $request->tags,
                'description' => $request->description,
                'time' => $request->time,
                'category' => $request->category,
            ]);

            return redirect()->back()->with(['success' => $save ? true : false]);
        } catch (Exception $e) {
            Log::error("Publishing Error: " . $e->getMessage());
            return redirect()->back()->with(['fail' => true]);
        }
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
