@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex">
                    <span class="fw-bold fs-4">Lista users</span>
                   
                </div>
                <div class="card-body">
                    <ul class="list-group">

                        @foreach ($users as $user)
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="left-index">
                                    <div class="top-div">{{$user->name}}</div>
                                    <div class="bottom-div">
                                        {{$user->email}}
                                    </div>
                                </div>
                                {{-- <div class="ms-auto">
                                    <a href="{{route('admin.posts.show',$post->slug)}}"><i class="fa-solid fa-eye" title="Dettagli post"></i></a>
                                </div> --}}
                                <form action="{{route('admin.users.destroy',$user->id)}}" method="POST">
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