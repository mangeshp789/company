<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employment extends Model
{
    protected $table = "employment";

    protected $fillable = [
        'id',"name","depart_id"
    ];


    
}
