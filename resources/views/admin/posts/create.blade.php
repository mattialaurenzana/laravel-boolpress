@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Aggiunta di un nuovo post
                </div>
                <div class="card-body">
                    <form action="{{route('admin.posts.store')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                          <label for="exampleInputTitle" class="form-label">Title</label>
                          <input type="text" placeholder="Inserisci il titolo" class="form-control @error('title')
                            is-invalid                              
                          @enderror" name="title" value="{{old('title')}}">
                          @error('title')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputContent" class="form-label">Content</label>
                          <textarea name="content" class="form-control  @error('content') is-invalid @enderror" placeholder="Inserisci il contenuto">{{old('content')}}</textarea>
                          @error('content') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Salva post</button>
                        <a href="{{route('admin.posts.index')}}" class="btn btn-danger">Annulla</a>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection