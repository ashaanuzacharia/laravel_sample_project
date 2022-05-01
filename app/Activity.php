<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Activity extends Model
{
    protected $table = 'activity';

    protected $fillable = [
       'user_id' ,'type', 'activity'
    ];
    
    public function add()
    {
        return $this->belongsToMany('App\Activity');
    } 
    
    public function edit()
    {
        return $this->belongsToMany('App\Activity');
    } 

    public function view()
    {
        return $this->belongsToMany('App\Activity');
    } 
}
