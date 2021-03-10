<?php
namespace App\Http\Controllers\Site;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;
use Illuminate\Support\Arr;
use App\Models\ResourceFile;
use App\Models\Image;
use Illuminate\Support\Facades\Config;
use File;
use Illuminate\Support\Facades\Storage;
class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return response()->json(["data" => "resource site index method","status" => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $resource = Resource::find($id);
        
        if($resource){
            $resource->views = $resource->views + 1;    
            $resource->save();
        }
            

        if($resource){
            return response()->json(
            [
            "data" => [ 
                "resource"  => $resource ,
                "images"    => $resource->images ,
                "files"     => $resource->files ,
                "category"  => $resource->category,
            ],
            "status" => true]
            );    
        }else{
            return response()->json(
            [
            "data" =>null,
            "status" => false]
            );
        }


        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        //
    }

    /**
     * { function_description }
     *
     * @param      <type>  $type      The type
     * @param      <type>  $keywords  The keywords
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function suggest($type ,$keywords){
        $searchResults = (new Search())
            ->registerModel(Resource::class, function(ModelSearchAspect $modelSearchAspect) use ($type){
               $modelSearchAspect
                ->addSearchableAttribute('title')
                ->addSearchableAttribute('keywords') // return results for partial matches on usernames
                // ->addExactSearchableAttribute('email') // only return results that exactly e.g email
                ->type($type);  // resourceCategoryId image 1 video 2 
        })->search($keywords)->take(7);
            
            $suggestedKeywords = [];
            foreach($searchResults as $row){
                $suggestedKeywords = array_merge($suggestedKeywords , $row->searchable->keywords);
            }
            $suggestedKeywords = array_unique($suggestedKeywords);
            $temp_array = [];
            foreach ($suggestedKeywords as $value) {
                $arr = [];
                $arr['label'] = $value;    
                $arr["value"] = $value;
                $temp_array[] = $arr;
            }
            $suggestedKeywords = $temp_array;

            return response()->json(["data" =>$searchResults,"status" => true , 'suggestedKeywords'=> $suggestedKeywords ]);
    }

    /**
     * Searches for the first match.
     *
     * @param      <type>  $type      The type
     * @param      <type>  $keywords  The keywords
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function search($type ,$keywords){
            
       $searchResults = (new Search())
            ->registerModel(Resource::class, function(ModelSearchAspect $modelSearchAspect) use ($type){
               $modelSearchAspect
                ->addSearchableAttribute('title')
                ->addSearchableAttribute('keywords') // return results for partial matches on usernames
                // ->addExactSearchableAttribute('email') // only return results that exactly e.g email
                ->type($type)  // resourceCategoryId image 1 video 2 
                ->with(['category','images','files']);
            })->search($keywords);
       return response()->json(["data" =>$searchResults,"status" => true ,"searchedFor" => ["type" => $type, "keywords" => $keywords ]]);
    }

    public function download( $type , $id){
            
            if($type == "image"){

               $image = Image::find($id);
               $resource = $image->imageable;
               if($resource){
                    $resource->downloads = $resource->downloads+1;
                    $resource->save();
               }
               $url = $image->url; 
               return Storage::disk('public')->download("/resources/images/original/".$url);
            }            
            
            $file = ResourceFile::find($id);
            $url = $file->url;
            $resource = $file->resource;
            if($resource){
                $resource->downloads = $resource->downloads+1;
                $resource->save();
            }

            return Storage::disk('public')->download("/resources/files/".$url);
    }
}
