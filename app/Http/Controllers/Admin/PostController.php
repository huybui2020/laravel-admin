<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $post = Post::where('post_title', 'LIKE', "%$keyword%")
                ->orWhere('post_teaser', 'LIKE', "%$keyword%")
                ->orWhere('post_content', 'LIKE', "%$keyword%")
                ->orWhere('post_image', 'LIKE', "%$keyword%")
                ->orWhere('post_imgdesc', 'LIKE', "%$keyword%")
                ->orWhere('post_cateid', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $post = Post::latest()->paginate($perPage);
        }

        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cates = Category::pluck('cate_name', 'id');
        return view('admin.post.create', compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'post_title' => 'required',
			'post_teaser' => 'required',
			'post_content' => 'required',
			'post_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'post_imgdesc' => 'required'
        ]);
        $post = new Post();
        if($request->hasFile('post_image')){
            $image = $request->file('post_image');
            $name =  Str::slug($request->post_title).'.'.$image->getClientOriginalExtension();            
            $destinationPath = public_path('Upload/Post');
            $imagepath = $destinationPath.'/'.$name;
            $image->move($destinationPath, $name);
            $post->post_image = $name;
        }
        $post->post_title = $request->get('post_title');
        $post->post_teaser = $request->get('post_teaser');
        $post->post_content = $request->get('post_content');
        $post->post_imgdesc = $request->get('post_imgdesc');

        $post->save();
return redirect('admin/post')->with('flash_message', 'Post added!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'post_title' => 'required',
			'post_teaser' => 'required',
			'post_content' => 'required',
			'post_image' => 'required',
			'post_imgdesc' => 'required'
		]);
        $requestData = $request->all();
        
        $post = Post::findOrFail($id);
        $post->update($requestData);

        return redirect('admin/post')->with('flash_message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect('admin/post')->with('flash_message', 'Post deleted!');
    }
}
