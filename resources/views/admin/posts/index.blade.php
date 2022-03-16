@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    Lista post
                    <a href="{{route('admin.posts.create')}}" class="ms-auto">Aggiungi</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">

                        @foreach ($posts as $post)
                        <li class="list-group-item d-flex">
                            {{$post->title}} - {{$post->user->name}}  - {{isset($post->category) ? $post->category->name : "senza categoria"}}
                            <a href="{{route('admin.posts.show',$post->slug)}}" class="ms-auto">Mostra</a>
                        </li>
                        @endforeach

                      </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection