<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



//Route::post('processUpload', function (Request $request) {
//    $validation = $request->validate([
//        "photo" => 'required | file | image | mimes:jpeg,png,gif,webp | max:2048'
//    ]);
//    $file = $request->file('photo');
//    $extension = $file->getClientOriginalExtension();
//    $filename = 'profile-photo-' . time() . '.' . $extension;
//    $path = $file->storeAs('photos', $filename);
//
//    dd($path);
//});


Route::post('processUpload',[
    'uses' => 'PostController@getPhoto',
    'as' => 'blog.post'
]);


Route::get('/', [
    'uses' => 'PostController@getRandPost',
    'as' => 'blog.randpost'
]);

Route::get('post/{id}', [
    'uses' => 'PostController@getPost',
    'as' => 'blog.post'
]);
Route::get('post/{id}/like', [
    'uses' => 'PostController@getLikePost',
    'as' => 'blog.post.like'
]);

Route::get('about', function () {
    return view('other.about');
})->name('other.about');


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('', [
        'uses' => 'PostController@getAdminIndex',
        'as' => 'admin.index'
    ]);

    Route::get('create', [
        'uses' => 'PostController@getAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::post('create', [
        'uses' => 'PostController@postAdminCreate',
        'as' => 'admin.create'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PostController@getAdminEdit',
        'as' => 'admin.edit'
    ]);

    Route::get('delete/{id}', [
        'uses' => 'PostController@getAdminDelete',
        'as' => 'admin.delete'
    ]);

    Route::post('edit', [
        'uses' => 'PostController@postAdminUpdate',
        'as' => 'admin.update'
    ]);
});
Auth::routes();

Route::post('login', [
    'uses' => 'SigninController@signin',
    'as' => 'auth.signin'
]);
