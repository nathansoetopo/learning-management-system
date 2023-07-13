<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with('user', 'categories')->blogCategory($request->category ?? null)->blogTitle($request->title ?? null)->orderBy('created_at', 'desc')->paginate(6);

        if ($request->ajax()) {
            $blogs = $blogs->appends(['category' => $request->category ?? null, 'title' => $request->title ?? null]);

            return response()->json([
                'view' => view('landing_page.article.card', compact('blogs'))->render(),
                'next_page_url' => $blogs->nextPageUrl(),
                'previous_page_url' => $blogs->previousPageUrl(),
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'total_data' => $blogs->total()
            ]);
        }

        $categories = BlogCategory::withCount('articles')->get();

        return view('landing_page.article.index', compact('blogs', 'categories'));
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        return view('landing_page.article.detail', compact('blog'));
    }
}
