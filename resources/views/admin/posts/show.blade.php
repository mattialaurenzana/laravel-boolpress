@extends('layouts.app');

@section ('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <span><button type="button" class="btn btn-link"><a href="{{route('admin.posts.index')}}"><i class="fa-solid fa-arrow-left" title="Back"></i></a></button></span>
                    Dettagli post {{$post->id}}
                    <a href="{{route('admin.posts.edit',$post->slug)}}" class="ms-auto"><i class="fa-solid fa-pen-to-square" title="Modifica post"></i></a>
                    
                </div>
                <div class="card-body">
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
                            Data creazione: {{$post->created_at}} <br>
                            <hr>
                            Ultima modifica: {{$post->updated_at}} <br>
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