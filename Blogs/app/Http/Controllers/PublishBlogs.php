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
        try {
            $validation = $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,webp',
                'author' => 'required|string',
                'title' => 'required|string',
                'content' => 'required'
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $validation['image'] = $path;
            }

            $save = BlogData::create([
                'image' => $validation['image'],
                'author' => $validation['author'],
                'title' => $validation['title'],
                'content' => $validation['content']
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
}
