<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];


    public function organizations() {
        return $this->belongsToMany('App\Organization');
    }

}
