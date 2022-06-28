<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('')
    ->namespace('FrontEnd')
    ->group(function () {
        Route::resource('/product', ProductController::class);
        Route::resource('/', HomeController::class);
        Route::get('/add/{id}', 'CartController@add')->name('add');
        Route::get('/cart', 'CartController@index')->name('cart');
        Route::get('/carts/minus/{id}/{qty}', 'CartController@minus')->name('carts.minus');
        Route::get('/cart/delete/{id}', 'CartController@delete')->name('cart.delete');
        Route::get('/cart/destroy', 'CartController@destroy')->name('cart.destroy');
        //   home
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/policy', 'PolicyController@index')->name('policy');
        Route::get('/products/{slug}.html', 'ProductController@productByCategories')->name('product.productbycategories');
        Route::get('/product/{slug}.html', 'ProductController@details')->name('product.details');
        // checkout
        Route::get('/checkout', 'CheckoutController@index')->name('checkout');
        Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
        // order
        Route::get('/order', 'OrderController@index')->name('order');
        Route::get('/order/require/{id}', 'OrderController@Require')->name('order.require');
        Route::get('/order/{id}.html', 'OrderController@Detail')->name('order.detail');
    });

Route::prefix('/')
    ->namespace('Auth')
    ->name('auth.')->group(function () {
        Route::get('/login', 'LoginController@create')
            ->middleware('guest')
            ->name('login');

        Route::post('/login', 'LoginController@authenticate')
            ->middleware('guest')
            ->name('login');

        Route::post('/logoutAdmin', 'LoginController@logoutAdmin')
            ->name('logoutAdmin');

        Route::post('/logout', 'LoginController@logout')
            ->name('logout');

        Route::get('/register', 'RegisteredController@create')
            ->middleware('guest')
            ->name('register');
        Route::post('/register', 'RegisteredController@store')
            ->middleware('guest')->name('register');

        Route::get('/forgot', 'ForgotController@index')
            ->name('forgot');
    });

Route::prefix('backend')->name('backend.')
    ->namespace('BackEnd')
    ->middleware(['admin.auth', 'role:admin,admod'])
    ->group(function () {
        Route::get('/orders/Confirmed/{id}', 'OrderController@Confirmed')->name('orders.confirmed');
        Route::get('/orders/Shipping/{id}', 'OrderController@Shipping')->name('orders.shipping');
        Route::get('/orders/Delivered/{id}', 'OrderController@Delivered')->name('orders.delivered');
        Route::get('/orders/Cancelled/{id}', 'OrderController@Cancelled')->name('orders.cancelled');
        Route::delete('/users/delete/{id}', 'UserController@delete')->name('users.delete1');
        Route::get('/users/listdelete', 'UserController@listSoftDelete')->name('users.delete');
        Route::delete('/users/restoreUser/{user}', 'UserController@restoreUser')->name('users.restoreUser');
        Route::put('/products/UpLoad/{id}', 'ProductController@UpLoadStatus')->name('products.upload');
        Route::put('/categories/UpLoad/{id}', 'CategoryController@UpLoadStatus')->name('categories.upload');
        Route::resources([
            'orders' =>  OrderController::class,
            'dashboard' =>  DashboardController::class,
            'categories' => CategoryController::class,
            'products' => ProductController::class,
            'users' => UserController::class,
            'custom_users' => CustomUserController::class,
            'images' => ImageController::class,
            'menus' => MenuController::class,
            'permissions' => PermissionController::class,

        ]);
        //Admins
        Route::prefix('admins')->name('admins.')->middleware('role:admin')->group(function () {
            Route::get('/', 'AdminController@index')->name('index');
            Route::post('/', 'AdminController@store')->name('store');
            Route::get('/create', 'AdminController@create')->name('create');
            Route::get('/{id}/edit', 'AdminController@edit')->name('edit');
            Route::put('/{id}', 'AdminController@update')->name('update');
        });
        // Role
        Route::prefix('roles')->name('roles.')->middleware('role:admin')->group(function () {
            Route::get('/', 'RoleController@index')->name('index');
            Route::post('/', 'RoleController@store')->name('store');
            Route::get('/create', 'RoleController@create')->name('create');
            Route::get('/{id}/edit', 'RoleController@edit')->name('edit');
            Route::put('/{id}', 'RoleController@update')->name('update');
        });
        // Permissions
        Route::prefix('permissions')->name('permissions.')->middleware('role:admin')->group(function () {
            Route::get('/', 'PermissionController@index')->name('index');
            Route::post('/', 'PermissionController@store')->name('store');
            Route::get('/create', 'PermissionController@create')->name('create');
            Route::get('/{id}/edit', 'PermissionController@edit')->name('edit');
            Route::put('/{id}', 'PermissionController@update')->name('update');
        });
    });
