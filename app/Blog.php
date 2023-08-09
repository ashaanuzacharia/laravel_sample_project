<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
       'user_id' ,'image', 'title','sub_tittle','desc'
    ];
    
    public function add()
    {
        return $this->belongsToMany('App\Blog');
    } 
    
    public function edit()
    {
        return $this->belongsToMany('App\Blog');
    } 

    public function view()
    {
        return $this->belongsToMany('App\Blog');
    } 
}
