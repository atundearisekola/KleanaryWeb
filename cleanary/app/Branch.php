<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function adminuser()
	{
		return $this->belongsTo('App\Admin');
	}
}
