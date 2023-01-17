@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="text-align:center;">
                Edit Post
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <form action="/posts/{{$post->id}}" method="POST"> 
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="Name" value="{{old('name',$post->name)}}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control">{{old('description',$post->description)}}</textarea>
                </div>
                <div class="mb-3">
                    <select name="category_id" id="" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{$cat->id}}" {{ $cat->id == $post->category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button> 
                <a href="/posts" class="btn btn-success">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection