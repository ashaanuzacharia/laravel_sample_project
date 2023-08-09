<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
       'name' ,'price'
    ];
    
    public function add()
    {
        return $this->belongsToMany('App\Producr');
    } 
    
    public function edit()
    {
        return $this->belongsToMany('App\Product');
    } 

    public function view()
    {
        return $this->belongsToMany('App\Product');
    } 
}
