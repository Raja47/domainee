<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Category extends Model
{
    use SoftDeletes;

    protected $table = "categories";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name' ,'slug','url','description','status'  
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status'  => 'boolean'
    ];

    /**
     * { Category Resrouces }
     *
     * @return     <array>  ( objects of resources )
     */
    // public function leads(){
    // 	return $this->hasMany('App\Models\Lead','category_id','id');
    // }
}
