<?php

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

Route::get('/', function () {
    return view('pages.cleanary');
})->name('welcome');
//facebook
 Route::get('/login/{driver}', 'SocialLogin@redirectToProvider')->name('fblogin');
  Route::get('login/{driver}/callback', 'SocialLogin@handleProviderCallback');




Route::get('admin/register', ['uses'=>'AdminController@showRegistrationForm', 
	'as' => 'admincleanary']);
           Route::post('admin/register', ['uses'=>'AdminController@register',
           	'as' => 'admin.reg']);
           Route::get('Admin/requested/laundries', ['uses'=>'AdminController@ShowRequestedLaundry',
	'as' => 'requestedlaundry']);
           Route::get('admin/view/request/laundry/{id}', ['uses'=>'AdminController@viewlaundry',
	'as' => 'viewlaundry']);
           Route::get('view/pickup/laundry/{id}', ['uses'=>'PickerController@viewpickuplaundry',
	'as' => 'single.pickup']);
           Route::post('/confirm/request', ['uses'=>'AdminController@confirmrequest',
	'as' => 'confirm.equest']);
           Route::get('Admin/tobepick/laundries', ['uses'=>'PickerController@ShowTobepickLaundry',
	'as' => 'tobepickedlaundry']);
           Route::get('picker/pick/laundry/{id}', ['uses'=>'PickerController@picklaundry',
	'as' => 'picklaundry']);
           Route::get('picker/deliver/laundry/{id}', ['uses'=>'PickerController@deliverlaundry',
	'as' => 'deliverlaundry']);
           Route::get('Admin/picked/laundries', ['uses'=>'PickerController@ShowpickedLaundry',
	'as' => 'pickedlaundry']);
           Route::get('Admin/ready/delivery/laundries', ['uses'=>'PickerController@ShowDeliveryLaundry',
	'as' => 'deliverylaundry']);
           Route::get('Admin/search/laundry', ['uses'=>'PickerController@ShowSearchLaundry',
	'as' => 'searchlaundry']);

           

           Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('home/accountsetup', ['uses'=>'HomeController@accountsetup',
	'as' => 'acountsetup']);

Route::get('home/request/laundry', ['uses'=>'HomeController@RequestV',
  'as' => 'requestv']);

Route::get('home/editfavorite', ['uses'=>'HomeController@getfavorite',
	'as' => 'getfav']);

Route::post('/accountupdate', ['uses'=>'HomeController@accountupdate',
	'as' => 'acount.update']);

Route::post('/addfavorite', ['uses'=>'HomeController@addfavorite',
	'as' => 'add.favorite']);
Route::post('/makerequest', ['uses'=>'LaundryController@makerequest',
	'as' => 'make.request']);
Route::post('/vlaundry', ['uses'=>'LaundryController@viewlaundry',
	'as' => 'view.laundry']);
Route::get('image/{filename}', ['uses'=>'LaundryController@laundryimage',
  'as' => 'imageview']);

Route::post('/pay', [
    'uses' => 'PaymentController@redirectToGateway',
    'as' => 'pay'
]);

Route::get('admin/branchform', ['uses'=>'BranchController@showBranchForm', 
	'as' => 'branchform']);
           Route::post('admin/addbranch', ['uses'=>'BranchController@addbranch',
           	'as' => 'add.branch']);

// Laravel 5.0
Route::get('payment/callback', [
    'uses' => 'PaymentController@handleGatewayCallback'
]); 

Route::get('payment/response', [
    'uses' => 'PaymentController@Resp',
    'as'=>'resp'
]); 

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('adminlogin');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('adminlogout');

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('adminregister');
  Route::post('/register', 'AdminAuth\RegisterController@register');
  Route::get('/branch/register', 'BranchadminAuth\RegisterController@showRegistrationForm')->name('pickerregister');
  Route::post('/branch/register', 'BranchadminAuth\RegisterController@register');


  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('adminpassword.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('adminpassword.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('adminpassword.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
  
});

Route::group(['prefix' => 'branchadmin'], function () {
  Route::get('/login', 'BranchadminAuth\LoginController@showLoginForm')->name('branchlogin');
  Route::post('/login', 'BranchadminAuth\LoginController@login');
  Route::post('/logout', 'BranchadminAuth\LoginController@logout')->name('logout');

  
  Route::post('/password/email', 'BranchadminAuth\ForgotPasswordController@sendResetLinkEmail')->name('branchpassword.request');
  Route::post('/password/reset', 'BranchadminAuth\ResetPasswordController@reset')->name('branchpassword.email');
  Route::get('/password/reset', 'BranchadminAuth\ForgotPasswordController@showLinkRequestForm')->name('branchpassword.reset');
  Route::get('/password/reset/{token}', 'BranchadminAuth\ResetPasswordController@showResetForm');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
