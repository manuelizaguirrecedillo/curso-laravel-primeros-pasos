<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       // return route("post.create");
      // return redirect("/post/create");
      //return redirect()->route("post.create");
     // return to_route("post.create");
      
     //dd(Category::find(1)->posts);

       //traer la info  $posts =Post::get();
         $posts =Post::paginate(2);
     return  view('dashboard.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $categories= Category::pluck('id','title');
            $post= new Post();
           echo view('dashboard.post.create',compact('categories','post'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

         // $request->validate(StoreRequest::myRules() );
           //
           //$validated = Validator::make($request->all(),StoreRequest::myRules());
           //dd($validated->errors());
           //dd($validated->failed());
        // $data= array_merge($request->all(),['image'=>'']);
          
       //$data=  $request->validated();

       //$data['slug']= Str::slug($data['title']);
       //dd($data);



          //crear un modelo osea insertarlo con los datos validados
          Post::create($request->validated());
          return to_route("post.index")->with('status','Registro creado');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       
        echo view('dashboard.post.show',compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       
       
       
        $categories= Category::pluck('id','title');
        
        echo view('dashboard.post.edit',compact('categories','post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PutRequest $request, Post $post)
    {
      //  dd($request->validated());


        $data =$request->validated();
      if( isset($data['image'])    ){
      
      
    //    dd($request->validated()['image']->getClientOriginalName()); 

        $data["image"]  = $filename=time().".".$data['image']->extension();
        
          //data no validada
          $request->image->move(public_path("image"),$filename);
      }




       $post->update($data);

     //  $request->session()->flash('status','Registro actualizado');
       return to_route("post.index")->with('status','Registro actualizado');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      //  return to_route("post");
       echo "destoy";
      $post->delete();
      return to_route("post.index")->with('status','Registro Eliminado');

      
    }
}
