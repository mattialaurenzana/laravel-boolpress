<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(7);
        $posts->load(["user","category","tags"]);
        return response()->json($posts);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title"=>"required|min:6",
            "content"=>"required|min:25",
            "post_img"=>"nullable",
            "category_id"=>"nullable",
            "tags"=>"nullable",
            
        ]);

        $newPost = new Post();
        $newPost->fill($data);
        $slug = Str::slug($newPost->title);
        $exist = Post::where("slug",$slug)->first(); //se non viene trovato nulla la variabile exist rimane null, se viene trovato qualcosa avrò l'istanza del post
        $counter = 1;
        while($exist){
            $newSlug = $slug . "-" . $counter;
            $counter ++;
            $exist = Post::where("slug",$newSlug)->first();
 
            if(!$exist){
             $slug = $newSlug;
         }
 
        }
 
        $newPost->slug = $slug;
        $newPost->user_id = 4;
        $newPost->save();
        if(key_exists("tags",$data)){
            $newPost->tags()->detach();
            $newPost->tags()->attach($data["tags"]);
        }
        return response()->json($newPost);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug",$slug)->first();

        if(!$post){
            abort(404);
           }
        $post->load(["user","tags","category"]);

       

        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
