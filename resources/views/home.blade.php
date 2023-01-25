@extends('layout')

@section('content')
    <div class="container">
        <div>
            <a href="/posts/create" class="btn btn-success">New Post</a>
            <a href="logout" class="btn btn-warning">Logout</a>
            <h4 style="float:right">{{Auth::user()->name}}</h4>
        </div><br>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong>{{ session('status') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('update'))
                <div class="alert alert-info alert-dismissible" role="alert">
                    <strong>{{ session('update') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('delete'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ session('delete') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="card">
            <div class="card-header" style="text-align:center;">
                Contents
            </div>
            
            <div class="card-body">
                @foreach($data as $post)
                    <div>
                        <h5 class="card-title">{{$post->name}}</h5>
                        <p class="card-text">{{$post->description}}</p>
                        <a href="/posts/{{$post->id}}" class="btn btn-primary">View</a>
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                        <form action="/posts/{{$post->id}}" method="post" style="display:inline;"> 
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div><hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection