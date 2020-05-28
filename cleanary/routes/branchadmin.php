<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('branchadmin')->user();

    //dd($users);

    return view('branchadmin.home');
})->name('home');

 Route::get('view/pickup/laundry/{id}', ['uses'=>'AdminController@viewpickuplaundry',
	'as' => 'single.pickup']);
           
           Route::get('Admin/tobepick/laundries', ['uses'=>'AdminController@ShowTobepickLaundry',
	'as' => 'tobepicklaundry']);
           Route::post('picker/pick/laundry/{id}', ['uses'=>'AdminController@picklaundry',
	'as' => 'pick.laundry']);
           Route::post('picker/deliver/laundry/{id}', ['uses'=>'AdminController@deliverlaundry',
	'as' => 'deliver.laundry']);
           Route::get('Admin/picked/laundries', ['uses'=>'AdminController@ShowpickedLaundry',
	'as' => 'pickedlaundry']);
           Route::get('Admin/ready/delivery/laundries', ['uses'=>'AdminController@ShowDeliveryLaundry',
	'as' => 'deliverylaundry']);

