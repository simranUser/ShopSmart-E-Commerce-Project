<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//default routes for material dashboard
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth')->middleware('role');
Route::get('/userhome', 'App\Http\Controllers\HomeController@user')->name('user')->middleware('auth');
Route::get('/vendorhome', 'App\Http\Controllers\HomeController@vendor')->name('vendorhome')->middleware('auth');;

//auth routes
Route::group(['middleware' => 'auth'], function () 
{
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	//vendor
	Route::group(['middleware' => 'vendor'], function () 
	{
		//products
		Route::group(['middleware' => 'checkvendor'], function () 
		{
			Route::get('/vendorform', 'App\Http\Controllers\ProductController@show')->name('vendorform');
			Route::post('/insertProduct', 'App\Http\Controllers\ProductController@store')->name('addproducts');
			Route::post('/updateProduct', 'App\Http\Controllers\ProductController@update')->name('updateproducts');
			Route::get('/viewProducts', 'App\Http\Controllers\ProductController@index')->name('viewproducts');
			Route::get('/editproduct/{uuid}', 'App\Http\Controllers\ProductController@edit')->name('editproduct');
			Route::post('/deleteproduct', 'App\Http\Controllers\ProductController@destroy')->name('deleteproduct');
			Route::post('/uploadproduct', 'App\Http\Controllers\ProductController@upload')->name('uploadproduct');
			Route::post('/rejectproduct', 'App\Http\Controllers\ProductController@reject')->name('rejectproduct');
			Route::get('/addProduct', 'App\Http\Controllers\ProductController@showAddProduct')->name('addProduct');
		});

	});

	//admin
	Route::group(['middleware' => 'admin'], function () 
	{
		//category
		Route::post('addCategory', [App\Http\Controllers\CategoryController::class,'store'])->name('addcategory');
		Route::post('editcategory', [App\Http\Controllers\CategoryController::class,'edit'])->name('editcategory');
		Route::post('deletecategory', [App\Http\Controllers\CategoryController::class,'destroy'])->name('destroycategory');
		Route::post('updateCategory', [App\Http\Controllers\CategoryController::class,'update'])->name('updatecategory');
		//products
		Route::get('/allProducts', 'App\Http\Controllers\AdminProductController@show')->name('allproducts');
		Route::post('/vendorfilter', 'App\Http\Controllers\AdminProductController@filter')->name('vendorfilter');
		Route::post('/editproduct', 'App\Http\Controllers\AdminProductController@editproduct')->name('editproductadmin');
		Route::post('/updateproduct', 'App\Http\Controllers\AdminProductController@updateproduct')->name('updateproductadmin');
		Route::post('/accept', 'App\Http\Controllers\AdminProductController@accept')->name('accept');
		Route::post('/reject', 'App\Http\Controllers\AdminProductController@reject')->name('reject');
		Route::get('/adminVendors', 'App\Http\Controllers\AdminVendorsController@show')->name('vendor');
		Route::post('/acceptVendor', 'App\Http\Controllers\AdminVendorsController@accept')->name('acceptvendor');
		Route::post('/rejectVendor', 'App\Http\Controllers\AdminVendorsController@reject')->name('rejectvendor');
		Route::get('/adminOrders', 'App\Http\Controllers\AdminOrdersController@show')->name('vendor');

	});
});

Route::post('/addtocart', 'App\Http\Controllers\AddToCartController@put')->name('vendor');
Route::get('/getcart', 'App\Http\Controllers\AddToCartController@get')->name('vendor');
Route::get('cart', [App\Http\Controllers\AddToCartController::class, 'cart'])->name('cart');
Route::patch('update-cart', [App\Http\Controllers\AddToCartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart',[App\Http\Controllers\AddToCartController::class, 'remove'])->name('remove.from.cart');
Route::get('checkoutview',[App\Http\Controllers\CheckoutController::class, 'checkoutview'])->name('checkoutview');

Route::get('/checkoutForm','App\Http\Controllers\CheckoutController@form')->name('checkoutForm');
Route::post('/create','App\Http\Controllers\CheckoutController@create')->name('create');

//test routes
Route::post('/removeSession','App\Http\Controllers\AddToCartController@removeSession')->name('create');
Route::get('/mail','App\Http\Controllers\taskController@mail')->name('mail');
Route::post('/insertorder','App\Http\Controllers\AddToCartController@order')->name('order');

//route for storage pictures as symlink was giving issue
Route::get('storage/uploads/{filename}', function ($filename)
{
    $path = storage_path('app/public/uploads/'.$filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

// Route::get('/chart',function(){
// 	return view('chart');
// });
Route::get('/chart','App\Http\Controllers\taskController@chart')->name('chart');
