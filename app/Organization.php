<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo_filename', 'established', 'revenue_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function causes() {
        return $this->belongsToMany('App\Cause');
    }



}
