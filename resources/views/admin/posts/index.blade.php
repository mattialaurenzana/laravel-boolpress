@extends('layouts.app')

@section('content')
<?php use Carbon\Carbon; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    <span class="fw-bold fs-4">Lista post</span>
                    <a href="{{route('admin.posts.create')}}" class="ms-auto">Aggiungi</a>
                </div>
                <div class="card-body">
                    <ul class="list-group">

                        @foreach ($posts as $post)
                            <li class="list-group-item d-flex align-items-center">
                                <div class="left-index">
                                    <div class="top-div">{{$post->title}}</div>
                                    <div class="bottom-div">
                                        {{$post->user->name}} - {{isset($post->category) ? $post->category->name : "senza categoria"}} - {{$post->created_at->format('Y-m-d')}}
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{route('admin.posts.show',$post->slug)}}"><i class="fa-solid fa-eye" title="Dettagli post"></i></a>
                                </div>
                                <form action="{{route('admin.posts.destroy',$post->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <div class="ms-auto">
                                        <button type="submit" class="btn btn-link text-danger ms-3"><i class="fa-regular fa-trash-can" title="Elimina post"></i></button>
                                    </div>
                                </form>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection