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

//Route::get('/', function () {
//
//    return view('welcome');
//});
Route::get('/','Api\GeneralController@getOneSemester');
Route::get('/testsend','Api\GeneralController@testsend');
Route::post('/approveOrder','Api\GeneralController@approveOrder');
Route::post('/rejectOrder','Api\GeneralController@rejectOrder');
Route::get('/visitOrder/{hash}','Api\GeneralController@visitOrder');
Route::post('/checkUserEmail','Api\GeneralController@checkUserEmail');
Route::post('/saveOrderOfficeToles', 'Api\GeneralController@saveOrderOfficeToles');
Route::post('/printPDF', 'Admin\OrdersController@printPDF');
Route::get('/checkUserEmail', function () {
    return redirect('/');
});
Route::get('/success', function () {
    return redirect('/');
});
Route::get('/saveOrderOfficeToles', function () {
    return redirect('/');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('/login', 'AuthController@login')->name('admin.login');
    Route::post('/login', 'AuthController@loginPost')->name('admin.login.post');
    Route::get('/logout', 'AuthController@logout')->name('admin.logout');
    Route::post('/addNewQuestion', 'PageController@addNewQuestion');
    Route::post('/saveUpdateUser', 'PageController@saveUpdateUser');
    Route::post('/addNewUser', 'PageController@addNewUser');
    Route::post('/deleteCategoryUser', 'PageController@deleteCategoryUser');
    Route::post('/deleteCategoryRow', 'PageController@deleteCategoryRow');
    Route::post('/getUsersByLocation', 'PageController@getUsersByLocation');
    Route::group(['middleware' => ['auth', 'auto-check-permission']], function () { //
        Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');

        Route::get('/admins', 'AdminController@admins')->name('admin.admins');
        Route::get('/admin/create', 'AdminController@adminCreate')->name('admin.admins.create');
        Route::post('/admin/create', 'AdminController@adminStore')->name('admin.admins.create');
        Route::get('/admin/edit/{id}', 'AdminController@adminEdit')->name('admin.admins.edit');
        Route::post('/admin/edit/{id}', 'AdminController@adminUpdate')->name('admin.admins.edit');
        Route::post('/admin/delete/{id}', 'AdminController@adminDelete')->name('admin.admins.delete');

        Route::resource('permission', 'PermissionController');

        Route::resource('role', 'RoleController')->except('destroy');
        Route::post('/admin/destroy/{id}', 'RoleController@destroy')->name('admin.admins.destroy');

        Route::get('/users', 'UserController@users')->name('admin.users');
        Route::get('/user/create', 'UserController@userCreate')->name('admin.users.create');
        Route::get('/user/posts/{id}', 'UserController@userPosts')->name('admin.users.posts');
        Route::get('/user/surveys/{id}', 'UserController@userSurveys')->name('admin.users.surveys');
        Route::post('/getUserStatistic', 'UserController@getUserStatistic')->name('admin.surveys');
        Route::post('/user/create', 'UserController@userStore')->name('admin.users.create');
        Route::get('/user/edit/{id}', 'UserController@userEdit')->name('admin.users.edit');
        Route::post('/user/edit/{id}', 'UserController@userUpdate')->name('admin.users.edit');
        Route::post('/user/delete/{id}', 'UserController@userDelete')->name('admin.users.delete');


        Route::get('/orders', 'OrdersController@orders')->name('admin.orders');
        Route::get('/order/show/{id}', 'OrdersController@orderShow')->name('admin.orders.show');
        Route::post('/order/delete/{id}', 'OrdersController@orderDelete')->name('admin.orders.delete');
        Route::post('/order/delete/{id}', 'OrdersController@orderDelete')->name('admin.orders.delete');
//        Route::post('/order/printPDF', 'OrdersController@printPDF')->name('admin.orders.printPDF');



        Route::get('/categories', 'CategoryController@categories')->name('admin.categories');
        Route::get('/category/create', 'CategoryController@categoryCreate')->name('admin.categories.create');
        Route::post('/category/create', 'CategoryController@categoryStore')->name('admin.categories.create');
        Route::get('/category/edit/{id}', 'CategoryController@categoryEdit')->name('admin.categories.edit');
        Route::post('/category/edit/{id}', 'CategoryController@categoryUpdate')->name('admin.categories.edit');
        Route::post('/category/delete/{id}', 'CategoryController@categoryDelete')->name('admin.categories.delete');

        Route::get('/semesters', 'SemesterController@semesters')->name('admin.semesters');
        Route::get('/semester/create', 'SemesterController@semesterCreate')->name('admin.semesters.create');
        Route::post('/semester/create', 'SemesterController@semesterStore')->name('admin.semesters.create');
        Route::get('/semester/edit/{id}', 'SemesterController@semesterEdit')->name('admin.semesters.edit');
        Route::post('/semester/edit/{id}', 'SemesterController@semesterUpdate')->name('admin.semesters.edit');
        Route::post('/semester/delete/{id}', 'SemesterController@semesterDelete')->name('admin.semesters.delete');


        Route::post('/semester/disabled/{id}', 'SemesterController@semesterDisabled')->name('admin.semesters.edit');
        Route::post('/semester/duplicate/{id}', 'SemesterController@semesterDuplicate')->name('admin.semesters.duplicate');
        Route::post('/semester/activated/{id}', 'SemesterController@semesterActivated')->name('admin.semesters.edit');
        Route::post('/semester/delete/{id}', 'SemesterController@semesterDelete')->name('admin.semesters.delete');


        Route::get('/products', 'ProductController@products')->name('admin.products');
        Route::get('/product/create', 'ProductController@productCreate')->name('admin.products.create');
        Route::post('/product/create', 'ProductController@productStore')->name('admin.products.create');
        Route::get('/product/edit/{id}', 'ProductController@productEdit')->name('admin.products.edit');
        Route::post('/product/edit/{id}', 'ProductController@productUpdate')->name('admin.products.edit');
        Route::post('/product/delete/{id}', 'ProductController@productDelete')->name('admin.products.delete');

        Route::get('/departments', 'DepartmentController@departments')->name('admin.departments');
        Route::get('/department/create', 'DepartmentController@departmentCreate')->name('admin.departments.create');
        Route::post('/department/create', 'DepartmentController@departmentStore')->name('admin.departments.create');
        Route::get('/department/edit/{id}', 'DepartmentController@departmentEdit')->name('admin.departments.edit');
        Route::post('/department/edit/{id}', 'DepartmentController@departmentUpdate')->name('admin.departments.edit');
        Route::post('/department/delete/{id}', 'DepartmentController@departmentDelete')->name('admin.departments.delete');


        Route::get('/settings', 'SettingController@index')->name('settings');
        Route::post('/settings/update', 'SettingController@update')->name('settings.update');
    });
});


Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
    return back();
});
