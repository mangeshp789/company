<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
	protected $table = "company";

    protected $fillable = [
        'id',"name"
    ];

    public function department_all()
    {
    	return $this->hasMany('App\department');
    }
}


