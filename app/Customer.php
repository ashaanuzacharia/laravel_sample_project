<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
       'name' ,'discount'
    ];
    
    public function add()
    {
        return $this->belongsToMany('App\Customer');
    } 
    
    public function edit()
    {
        return $this->belongsToMany('App\Customer');
    } 

    public function view()
    {
        return $this->belongsToMany('App\Customer');
    } 
}
