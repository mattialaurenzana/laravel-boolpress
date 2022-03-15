<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
            "content"=>"required|min:25"
        ]);
       $post = new Post();
       $post->fill($data);

       $slug = Str::slug($post->title);
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

       $post->slug = $slug;

 
       $post->save();

       return redirect()->route('admin.posts.index');
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
        return view('admin.posts.show',compact("post"));
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
        $data = $request->validate([
            "title"=>"required|min:6",
            "content"=>"required|min:25"
        ]);

        $post = Post::findOrFail($id);

        if($data["title"] !== $post->title){ //significa che l'utente ha cambiato il titolo,devo rigenerare lo slug del post

            $slug = Str::slug($data["title"]);
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

            $data["slug"] = $slug;
        }

        $post->update($data);
        return redirect()->route("admin.posts.show",$post->id);
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
