<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //bahagian destroy
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //this function to unable when click blog it not keluar all posts,
    //kena login dulu baru boleh tgk post
    //so nak view kan semua post kena add exception ['except' => ['index', 'show']]
    //so bila type posts/create dia tkkan keluar create post selagi tk log in, jadi dia keluar login page
    public function __construct()
    {
//        to block everything in the dashboard if the user are not
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();// show all without order
        //$posts = Post::orderBy('title', 'asc')->get();//susun dalam order
        //$posts = Post::orderBy('title', 'desc')->take(1)->get();//susun dalam order
        //$posts = DB::select('SELECT * FROM posts');//get from the database
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);//utk buat page

      //return $post = Post::where('title', 'two')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * take variable from the form
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
//            1999 under 2 mgb
            'cover_image' => 'image|nullable|max:1999'
        ]);
        //return 123;//try return page after fill in the form in the
        //HANDLE FILE UPLOAD
        if($request->hasFile('cover_image')){
            //GET FILENAME WITH THE EXTENSION
            //extension tu yg .jpg/. n so on
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //GET JUST FILENAME
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //GET JUST EXTENSION
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //FILENAME TO STORE
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //UPLOAD IMAGE
            //(public/cover_images) will go to storage-->app-->public
            $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        //CREATE POST
        //save in the database
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

//      return to main page of blog (/posts)
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        to check the id
//        return Post::find($id);
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        //CHECK FOR CORRECT USER
        if(auth()->user()->id !==$post->user_id){
//            unauthorize page is message
            return redirect ('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //same like store, just change no new Post because we edit on current
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        //return 123;//try return page after fill in the form in the

        //HANDLE FILE UPLOAD
        if($request->hasFile('cover_image')){
            //GET FILENAME WITH THE EXTENSION
            //extension tu yg .jpg/. n so on
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //GET JUST FILENAME
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //GET JUST EXTENSION
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //FILENAME TO STORE
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //UPLOAD IMAGE
            //(public/cover_images) will go to storage-->app-->public
            $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        //save in the database
        $post = Post::find($id);//find the post using $id
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image=$fileNameToStore;
        }
        $post->save();

//      return to main page of blog (/posts)
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        //CHECK FOR CORRECT USER
        if(auth()->user()->id !==$post->user_id){
//            unauthorize page is message
            return redirect ('/posts')->with('error', 'Unauthorized Page');
        }
        if($post->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
