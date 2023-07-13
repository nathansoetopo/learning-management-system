<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::with('user', 'categories')->get();

        return view('dashboard.superadmin.article.index', compact('blogs'));
    }

    public function create(){
        $categories = BlogCategory::all();

        return view('dashboard.superadmin.article.create', compact('categories'));
    }

    public function store(StoreArticleRequest $request){
        $data = $request->except(['_token', '_image', 'category']);

        $asset = $request->file('image')->store('blog');
        $asset = asset('storage/'.$asset);

        $data['user_id'] = Auth::user()->id;
        $data['image'] = $asset;

        $create = Blog::create($data);

        $create->categories()->attach($request->category);

        return redirect()->route('superadmin.blog.index')->with('success', 'Berhasil Menambahkan Blog');
    }

    public function edit($id){
        $blog = Blog::find($id);
        $categories = BlogCategory::all();

        return view('dashboard.superadmin.article.edit', compact('blog', 'categories'));
    }

    public function update($id, UpdateArticleRequest $request){
        $blog = Blog::find($id);

        $asset = $blog->image;

        if($request->hasFile('image')){

            if(File::exists(parseUrl($asset))){
                File::delete(parseUrl($asset));
            }

            $asset = $request->file('image')->store('blog');
            $asset = asset('storage/'.$asset);
        }

        $data = $request->except(['_token', '_image', 'category']);
        $data['image'] = $asset;

        $blog->categories()->sync($request->category);
        $blog->update($data);

        return redirect()->route('superadmin.blog.index')->with('success', 'Berhasil Mengubah Blog');
    }

    public function delete($id){
        $blog = Blog::find($id);

        $asset = $blog->image;

        if(File::exists(parseUrl($asset))){
            File::delete(parseUrl($asset));
        }

        $blog->delete();

        return redirect()->route('superadmin.blog.index')->with('success', 'Berhasil Menghapus Blog');
    }

    public function categoryList(Request $request){
        $categories = BlogCategory::all();

        if($request->ajax()){
            return response()->json([
                'status'    => 200,
                'data'      => $categories
            ]);
        }

        return view('dashboard.superadmin.article.category.index');
    }

    public function showCategory($id){
        $category = BlogCategory::find($id);

        return $category;
    }

    public function categoryStore(Request $request){
        $create = BlogCategory::create($request->except(['_token']));

        return $create;
    }

    public function updateCategory($id, Request $request){
        $update = BlogCategory::find($id);

        $update->update($request->except(['_token', '_method']));

        return $update;
    }

    public function deleteCategory($id){
        $delete = BlogCategory::find($id);

        $delete->delete();

        return $delete;
    }
}
