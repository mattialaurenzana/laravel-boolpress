@extends('layouts.app');

@section ('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <span><button type="button" class="btn btn-link"><a href="{{route('admin.posts.index')}}"><i class="fa-solid fa-arrow-left" title="Indietro"></i></a></button></span>
                    <span class="fw-bold fs-4">Dettagli post {{$post->id}}</span>
                    <a href="{{route('admin.posts.edit',$post->slug)}}" class="ms-auto"><i class="fa-solid fa-pen-to-square" title="Modifica post"></i></a>
                    
                </div>
                <div class="card-body">
                    <div class="img-container">
                        <img src="{{$post->post_img ? $post->post_img : "https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640"}}" alt="post image">
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Title: {{$post->title}} <br>
                            <hr>
                            Content: {{$post->content}} <br>
                            <hr>
                            Category: {{$post->category->name}} <br>
                            <hr>
                            Utente: {{$post->user->name}} <br>
                            <hr>
                            Email: {{$post->user->email}} <br>
                            <hr>
                            Data creazione: {{$post->created_at->format('Y-m-d')}} <br>
                            <hr>
                            <?php 
                                use Carbon\Carbon;
                                $date = new Carbon();
                            ?>
                            Ultima modifica: {{$post->updated_at->diffForHumans($date::now())}} <br>
                            <hr>
                            Tags: 
                            @foreach ($post->tags as $tag)
                                {{$tag->name}},
                            @endforeach
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection