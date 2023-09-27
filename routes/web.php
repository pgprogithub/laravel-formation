<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
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
*/
//password = dary nazar

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('blog', PostsController::class);

