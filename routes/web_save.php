<?php

use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeInvokeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



/*
The different method

GET -request a resource
POST -Request a  create new resource
PUT -update a new resource
DELETE -Delate a resource
OPTIONS - Asked a server wich verbs are allowed
*/




// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('blog',PostsController::class);

Route::get('/',HomeInvokeController::class);



/*
// GET
//  Route::get('/blog',[TestController::class,'index'])->name('blog.index');
 Route::get('/blog',[PostsController::class,'index'])->name('blog.index');
Route::get('/blog/{id}',[PostsController::class,'show'])->name('blog.show');
// Route::get('/blog/{id}',[PostsController::class,'show'])->where('id','[0-9]+');
// Route::get('/blog/{id}',[PostsController::class,'show'])->whereNumber('id','[0-9]+');
// Route::get('/blog/{name}',[PostsController::class,'show'])->where('name','[A-Za-z]+');
//  Route::get('/blog/{name}',[PostsController::class,'show'])->whereAlpha('name','[A-Za-z]+');
Route::get('/blog/{id}/{name}',[PostsController::class,'show'])->whereNumber('id')->whereAlpha('name');
// Route::get('/blog/{id}/{name}',[PostsController::class,'show'])->where([
//     'id'=>'[0-9]+',
//     'name'=>'[A-Za-z]+'
// ]);



// POST
Route::get('/blog/create',[TestController::class,'create'])->name('blog.create');
Route::post('/blog/{id}',[PostsController::class,'store'])->name('blog.store');


// PUT  OR PATCH
Route::get('/blog/edit/{id}',[TestController::class,'edit'])->name('blog.edit');
Route::patch('/blog/1',[PostsController::class,'update'])->name('blog.update');


// DELETE
Route::delete('/blog/{id}',[TestController::class,'destroy'])->name('blog.destroy');
*/

// Prefix route

Route::prefix('blog')->group(function(){

    // POST
    Route::get('/create',[PostsController::class,'create'])->name('blog.create');
    Route::post('/',[PostsController::class,'store'])->name('blog.store');


    // GET
//  Route::get('/',[TestController::class,'index'])->name('blog.index');
 Route::get('/',[PostsController::class,'index'])->name('blog.index');
 Route::get('/{id}',[PostsController::class,'show'])->name('blog.show');
 // Route::get('/{id}',[PostsController::class,'show'])->where('id','[0-9]+');
 // Route::get('/{id}',[PostsController::class,'show'])->whereNumber('id','[0-9]+');
 // Route::get('/{name}',[PostsController::class,'show'])->where('name','[A-Za-z]+');
 //  Route::get('/{name}',[PostsController::class,'show'])->whereAlpha('name','[A-Za-z]+');
 Route::get('/{id}/{name}',[PostsController::class,'show'])->whereNumber('id')->whereAlpha('name');
 // Route::get('/{id}/{name}',[PostsController::class,'show'])->where([
 //     'id'=>'[0-9]+',
 //     'name'=>'[A-Za-z]+'
 // ]);



    // PUT  OR PATCH
    Route::get('/edit/{id}',[PostsController::class,'edit'])->name('blog.edit');
    Route::patch('/{id}',[PostsController::class,'update'])->name('blog.update');
    // DELETE
    Route::delete('/{id}',[PostsController::class,'destroy'])->name('blog.destroy');
});



//Route::resource('blog',PostsController::class);

/* Route::get('/',function(){
     return view('index');
 }); */

// MULTIPLE HTTP verbs
// Use the match() method
//Route::match(['GET','POST'],'/blog',[PostsController::class,'index']);

// Use the any() method
// Route::any('/blog',[PostsController::class,'index']);

// Use the view() method
// Route::view('/blog','blog.index',['name'=>'Code width dary']);




// fallback route

Route::fallback(FallbackController::class);

