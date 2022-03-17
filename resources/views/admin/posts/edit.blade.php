@extends('layouts.app');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Modifica post {{$post->id}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.posts.update',$post->slug)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                          <label for="exampleInputTitle" class="form-label">Title</label>
                          <input type="text" placeholder="Inserisci il titolo" value="{{$post->title}}" class="form-control @error('title')
                            is-invalid                              
                          @enderror" name="title" value="{{old('title')}}">
                          @error('title')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputContent" class="form-label">Content</label>
                          <textarea name="content" class="form-control  @error('content') is-invalid @enderror" placeholder="Inserisci il contenuto">{{$post->content}}{{old('content')}}</textarea>
                          @error('content') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option>--nessuna categoria--</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if ($post->category_id === $category->id) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="mb-0"><label class="form-label mb-0">Tags</label></div>
                                @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="{{$tag->name}}" name="tags[]" value="{{$tag->id}}" {{$post->tags->contains($tag) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="{{$tag->name}}">{{$tag->name}}</label>    
                                </div>                              
                                @endforeach
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