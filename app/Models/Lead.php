<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;



class Lead extends Model 
{
    use SoftDeletes;

    protected $table = "leads";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
    protected $fillable = [
       'title' , 'email' , 'phone_num' , 'description' , 'country','category_id' , 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * { Creator of Resource }
     *
     * @return     <collection object of User>
     */
   
    
    /**
     * 
     * { category of Resource }
     *
     * @return     <object>  ( category of Resource )
     */
    public function category(){

    	return $this->belongsTo("App\Models\Category",'category_id','id');
    }
    
    
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->isoFormat('MMM Do YY');
    }
    /**
     * { files that resource has }
     *
     * @return    <array>  (array of  ResourceFile collection Objects)
     */
   

    /**
     * { resrource Images }
     *
     * @return <array of Image objects Resources has>
     */
   

    /**
     * { filter resources of provided type }
     *
     * @param      <type>  $query  The query
     * @param      <type>  $type   ResourceCatgoryId
     *
     * @return     <Objects>  ( resources of $type )
     */

    

    
}
