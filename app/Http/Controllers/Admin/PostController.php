<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $categories = Category::all();
        $tags = Tag::all(); //vado a memorizzare nella variabile $tags tutti i record della tabella tags (model Tag)
        return view('admin.posts.create',compact(["categories","tags"]));
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
            "category_id"=>"nullable"
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
       $post->user_id = Auth::id(); //all'atto della creazione di un nuovo post assegno alla collonna user_id l'id dello user attualmente loggato
       
 
       $post->save();
       if(key_exists("tags",$data)){
        $post->tags()->detach();
        $post->tags()->attach($data["tags"]);
    }

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
    public function edit($slug)
    {
        $post = Post::where("slug",$slug)->first();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit',compact(["post","categories","tags"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        
        $data = $request->validate([
            "title"=>"required|min:6",
            "content"=>"required|min:25",
            "category_id"=>"nullable",
            "tags"=>"nullable"
        ]);

        $post = Post::where("slug",$slug)->first();

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
        if(key_exists("tags",$data)){
            $post->tags()->detach();
            $post->tags()->attach($data["tags"]);
        }
        return redirect()->route("admin.posts.show",$post->slug);
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
