<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laundry extends Model
{

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'favstarch', 'favperf', 'laundryimg','kleanaryinput','todoiron','todoperfume', 'todostarch',
    ];

	 protected $casts = [
        'favstarch' => 'array',
		'favperf' => 'array',
		'laundryimg' => 'array',
		'kleanaryinput' => 'array',
		'todoiron' => 'array',
		'todoperfume' => 'array',
		'todostarch' => 'array',
        
    ];
   
}
