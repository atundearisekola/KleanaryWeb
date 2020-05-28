<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::get('admin/register', ['uses'=>'AdminController@showRegistrationForm', 
	'as' => 'admincleanary']);
 Route::post('admin/register', ['uses'=>'AdminController@register',
           	'as' => 'admin.reg']);
           Route::get('Admin/requested/laundries', ['uses'=>'AdminController@ShowRequestedLaundry',
	'as' => 'requestedlaundry']);
   Route::get('admin/view/request/laundry/{id}', ['uses'=>'AdminController@viewlaundry',
	'as' => 'viewlaundry']);
Route::post('/confirmrequest', ['uses'=>'AdminController@confirmrequest',
	'as' => 'confirm.request']);
Route::get('Admin/search/laundry', ['uses'=>'AdminController@ShowSearchLaundry',
	'as' => 'searchlaundry']);


