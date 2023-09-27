<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
   public function __construct()
   {
            $this->middleware('auth')->only(['create', 'edit' ,'update', 'destroy']);
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // Interact width database
        // statemaent method return a boolean value
        $posts = DB::statement('SELECT * FROM posts');
        // dd($posts);
        // select method return a associative array that content more value
        // $posts = DB::select('SELECT * FROM posts');
        // $posts = DB::select('SELECT * FROM posts WHERE id=?', [1]);
        // $posts = DB::select('SELECT * FROM posts WHERE id=:id',['id' => 1]);

        // insert  the value in database laravelapp
        // $posts = DB::insert('INSERT INTO  posts(title,excerpt,body,image_path,is_published,min_to_read)
        //                 VALUES(?,?,?,?,?,?)
        //    ',
        //      ['test','test','test','test',true,1]
        //     );

        // update method in database laravelapp
        // $posts = DB::update('UPDATE posts SET body=? WHERE id=? ', ['body 2',301]);

        // delete method in database laravelapp
        // $posts = DB::delete('DELETE FROM posts  WHERE id=? ', [301]);

        // table method
        // $posts = DB::table('posts');
                     // get method on posts
                    //  $posts = DB::table('posts')->get();
                   //  $posts = DB::table('posts')
                        /*->select('title')*/
                        /*->select('title','body')*/
                        // ->where('id','>','50')
                        // ->where('id','50')
                        // ->whereBetween('min_to_read',[2,6])
                        // ->whereNotBetween('min_to_read',[2,6])
                        // ->whereNull('excerpt')
                        // ->whereNotNull('excerpt')
                        // ->select('min_to_read')
                        // ->distinct()
                        // ->orderBy('id','desc')
                        // ->orderBy('id','asc')

                        // define pagination
                        // ->skip(30)/*begin*/
                        // ->take(10)/*end*/
                        // ->inRandomOrder()/*return the aleatories values*/
                        // ->get()/*display the items*/

                        // ->first();/*return the fist row data in table */
                        // ->find(100);/*return the column that is primary key in table exemple id=100 */
                        // ->where('id',100)
                        // ->value('body');/*return the column to specify condition in table exemple body that id=100 */
                        // ->where('id','>','50')
                        // ->count()/*count row data*/;
                        // ->min('min_to_read');
                        // ->max('min_to_read');
                        // ->sum('min_to_read');
                        // ->avg('min_to_read');

    //    dd($posts);


                // pass data to the view
                    // the first method
                    // $posts =  DB::table('posts')->find(1);
                    // return view('blog.index')->with('posts',$posts);

                    // // second method
                    // $posts = DB::table('posts')->get();
                    // return view('blog.index',compact('posts'));


                    // third method
                    // $posts = DB::table('posts')->get();
                    // return view('blog.index',['posts' => $posts]);

//
                    // eloquent ...
                    // $posts = Post::all();//you can not change the order of value
                    // $posts = Post::orderBy('id','desc')->take(10)->get();
                    // $posts = Post::where('min_to_read',2)->get();
                    // $posts = Post::where('min_to_read','!=',2)->get();
                    // dd($posts);
                        //use the chunk method to extract a specific record
                    // $posts = DB::table('posts')->get();
                    // Post::chunk(25,function($posts){
                    //    foreach ($posts as $post) {
                    //     echo $post->title .'<br>'. $post->min_to_read .'<br>';
                    //    }
                    // });

                    // $posts = Post::get()->count();
                    // $posts = Post::sum('min_to_read');
                    // $posts = Post::avg('min_to_read');
                    // dd($posts);
        return view('blog.index',[
            // 'posts' => Post::orderBy('id','desc')->get()
            // the pagination of record
            'posts' => Post::orderBy('id','desc')->paginate(20)

        ]);
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
         return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( PostFormRequest $request)
    {
        //
           // the first method
        //    dd($request->all());
        //    $request->validated();
        // $posts = new Post();

        // $posts->title = $request->title;
        // $posts->excerpt = $request->excerpt;
        // $posts->body = $request->body;
        // // $posts->image_path = 'temporary';
        // $posts->image_path = $request->image;
        // $posts->is_published = $request->is_published === 'on';
        // $posts->min_to_read = $request->min_to_read;
        // $posts->save();// with laravel 9 you do not use save method to insert values in  database

        //  second method
        // dd($request->all());

            // dd($request->all());
            // exit;
        // $request->validated();
        //  dd($request->image);


        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $this->storeImage($request),
            'is_published' => $request->is_published === 'on',
            'min_to_read' => $request->min_to_read

                ]);

                $post->meta()->create([
                    'post_id' => $post->id,
                    'meta_description' => $request->meta_description,
                    'meta_keywords' => $request->meta_keywords,
                    'meta_robots' => $request->meta_robots

                                ]);



                    // third method
            //   $posts = new Post();
            //   $post = DB::insert('insert into  posts(title,excerpt,body,image_path,is_published,min_to_read)
            //    values (?, ?, ?, ?, ?, ?)', [
            //     $request->title,
            //     $request->excerpt,
            //     $request->body,
            //     'temporary',
            //     $request->is_published === 'on',
            //     $request->min_to_read

            // ]);

            return redirect(route('blog.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

            // dd($posts);
            return view('blog.show',[
                'post' =>  Post::findOrFail($id)
                // 'Categories' => Post::findOrFail($id)
           ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        return view('blog.edit',[
            'posts'  => Post::where('id',$id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         //
        // dd($request->except(['_token','_method']));

        $request->validate([
            'title' => 'required|max:255|unique:posts,title',$id,
            'excerpt' => 'required',
            'body' => 'required',
            // 'image' => ['mimes:png,jpg,jpeg,tif','max:5048'],
            'min_to_read' => 'min:0|max:60'
         ]);

            // second method
        // Post::where('id',$id)->update(
        //     $request->except(['_token','_method'])
        // );

        // fist method
        Post::where('id',$id)->update([

        'title' => $request->title,
        'excerpt' => $request->excerpt,
        'body' => $request->body,
        // 'image_path' => $request->image,
        'is_published' => $request->is_published === 'on',
        'min_to_read' => $request->min_to_read

        ]);

        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // dd('Test'.$id);

        Post::destroy($id);

        return redirect(route('blog.index'))->with('message','The post has been deleted.');

    }


    private function storeImage(PostFormRequest $request){
        $newImageName =  uniqid() .'-'. $request->title .'.'. $request->image->extension();
        return $request->image->move(public_path('images'),$newImageName);
    }
}
