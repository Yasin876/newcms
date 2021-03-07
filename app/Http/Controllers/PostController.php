<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\PostsRequests\StoreRequest;
use App\Http\Requests\PostsRequests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index')->with('posts', Post::all());
    }

    

    public function get_trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('trash.index')->with('trashedPost', $trashed);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')
            ->with('tagItems', Tag::all())
            ->with('categoryItems', Category::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $image = $request->image->store('postimages');

        $post = Post::create([
            'title' => $request->title,
            'post_content' => $request->post_content,
            'image_path' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category,

        ]);

        //post_tag tablosunda postlar ile tagleri eşleştiriyoruz
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post added');
        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create')
            ->with('postEdit', $post)
            ->with('categoryItems', Category::all())
            ->with('tagItems',Tag::all());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->only(['title', 'post_content', 'published_at']); //all() yerine only()

        //check image if has
        if ($request->hasFile('image')) {
            $image = $request->image->store('postImages');
            Storage::delete($post->image_path);//delete old picture
            $data['image_path'] = $image;
        }

        $post->update($data);

        session()->flash('success', 'Post updated');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //burada model binding kullanılmaz cunkü silinmis postlarıda cekmek istiyoruz
        $post = Post::withTrashed()->findOrFail($id); //Post::withTrashed()->where('id',$id)->firstOrFail();
        if ($post->trashed()) {
            //remove image from storage
            $post->delete_image();
            //remove remind post
            $post->forceDelete();

            session()->flash('success', 'post deleted permanently');
            return redirect()->back();

        } else {
            $post->delete(); //bu silmede tüm veriler deleted_at kolonuna gecer yani aslında kalıcı olarak silinmez
            session()->flash('success', 'post moved to garbage');
            return redirect('trashed');
        }

    }

    //WARNING : route kısmında {post} kullanılmaz cunku post parametresi bir modele baglıdır.
    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();
        session()->flash('success', 'Post restored successfully');
        return redirect()->back(); //back() metodu ile islem yaptıgımız sayfaya geri doneriz.
    }
}
