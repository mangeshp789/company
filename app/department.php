<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $table = "department";

    protected $fillable = [
        'id',"name","company_id"
    ];

    public function employment_all()
    {
    	return $this->hasMany('App\employment','depart_id','id');
    }

}
