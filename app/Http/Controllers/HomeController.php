<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Mail\PostStored;
use App\Models\Category;
use App\Mail\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\storePostRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreatedNotification;



class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        // $user = User::find(1);
        // $user->notify(new PostCreatedNotification());
        // Notification::send(User::find(1),new PostCreatedNotification());
        // echo 'noti sent'; exit();
        $data = Post::where('user_id',auth()->id())->orderBy('id','desc')->get();
        //$request->session()->flash('status', 'Task was successful!');
        return view('home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request,Post $post)
    {
        $validatedData = $request->validated();
        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();

        $post=Post::create($validatedData + ['user_id'=>Auth::user()->id]);
        return redirect('/posts')->with('status', config('ap.message.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) //Route model binding
    {
        //
        // if($post->user_id != auth()->id()){
        //     abort(403);
        // }        //manually filter

        $this->authorize('view',$post);
        return view('show',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) //Route model binding
     {
        //
        // if($post->user_id != auth()->id()){
        //     abort(403);
        // } //Manually filter
        $this->authorize('view',$post);
        $categories = Category::all();
        return view('edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storePostRequest $request,Post $post)
    {
        //
        // $post->name = $request->name;
        // $post->description = $request->description;
        // $post->save();
        $validatedData = $request->validated();
        $post->update($validatedData);

        return redirect('/posts')->with('update', config('ap.message.updated'));;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect('/posts')->with('delete', config('ap.message.deleted'));;
    }
}
