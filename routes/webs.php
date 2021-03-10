<?php
ini_set('max_execution_time', 0);
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

 Route::get('/user-image',[App\Http\Controllers\UserController::class, 'userImage']);

Route::get('/scrap', function() {
     
    $links = [];
   
    $crawler = Goutte::request('GET', 'https://morotai.com/collections/damen');	
    $crawler->filter('div.text-lg.pl-5.mb-4')->each(function ($node) use (&$links)  {
       $array = [];
       $array['category'] =  "Women>".$node->filter('a')->text() ;
        $category = $array['category'];
       if ( $node->filter('ul li a')->count() > 0 ){
			$node->filter('ul li a')->each( function ($nodeInner) use ( &$array ,&$links,&$category ){
       			$array['category' ] = $category.'>'.$nodeInner->text();
       			//$array['link' ] = $nodeInner->extract(['href'])[0];
       				
       				$productsCrawler = Goutte::request( 'GET' , "https://morotai.com".$nodeInner->extract(['href'])[0] );
       				$productsCrawler->filter('.product-list > div')->each(function ($productsNode , $i) use (&$array ,&$links) {
       					if($i > 1 ){
       						return "";
       					}
       					if($productsNode->filter('a')->count() > 0 ){
       						if(strpos($productsNode->filter('a')->first()->extract(['href'])[0] , '/products/')){
       							//$array['product_link'] = $productsNode->filter('a')->first()->extract(['href'])[0];
       							
       							$productCrawl   = Goutte::request( 'GET' , "https://morotai.com".$productsNode->filter('a')->first()->extract(['href'])[0] );
       							$array['name']  = $productCrawl->filter('.font-bold.text-3xl.mt-5')->text(); 
       							$array['price'] = $productCrawl->filter(".leading-none.mt-4 span:not(.text-grey-dark)")->text();
       							$array['image'] = $productCrawl->filter(".product-single-image-full")->extract(['src'])[0];
       							

       							// $productCrawl->filter(".product-tabs:first-child .tab")->each(function ($nodePrdDetails) use (&$array , &$links ){
       							// 	$array[$nodePrdDetails->filter('h3')->text()] = $nodePrdDetails->filter('.content')->html()	;		
       								
       							// }); 
       							$links[]=$array;
       							
       						}

       						
       					}

       				});	


       		}); 
       }else{
       		if($node->filter('a')->text()  != "New products" && $node->filter('a')->text()  != "Vouchers" ){
	       		//$array['link' ] = $node->filter('a')->extract(['href'])[0];

	       		$productsCrawler = Goutte::request( 'GET' , "https://morotai.com".$node->extract(['href'])[0] );
	       		$productsCrawler->filter('.product-list > div')->each(function ($productsNode , $i) use (&$array ,&$links) {
       					if($productsNode->filter('a')->count() > 0 ){
       					if($i > 1 ){
       						return "";
       					}

       						if(strpos($productsNode->filter('a')->first()->extract(['href'])[0] , '/products/')){
       							$array['product_link'] = $productsNode->filter('a')->first()->extract(['href'])[0];
       							
       							$productCrawl   = Goutte::request( 'GET' , "https://morotai.com".$array['product_link'] );
       							$array['name']  = $productCrawl->filter('.font-bold.text-3xl.mt-5')->text(); 
       							$array['price'] = $productCrawl->filter(".leading-none.mt-4 span:not(.text-grey-dark)")->text();
       							$array['image'] = $productCrawl->filter(".product-single-image-full")->extract(['src'])[0];
       							

       							// $productCrawl->filter(".product-tabs:first-child .tab")->each(function ($nodePrdDetails) use (&$array , &$links ){
       							// 	$array[$nodePrdDetails->filter('h3')->text()] = $nodePrdDetails->filter('.content')->html()	;		
       								
       							// }); 
       							$links[]=$array;
       							
       						}

       						
       					}
       			});
	       		
       		}
       }
      });  





    $crawler = Goutte::request('GET', 'https://morotai.com/collections/herren');	
    $crawler->filter('div.text-lg.pl-5.mb-4')->each(function ($node) use (&$links)  {
       $array = [];
       $array['category'] = "Men>".$node->filter('a')->text() ;
       $category = $array['category'];
       if ( $node->filter('ul li a')->count() > 0 ){

			$node->filter('ul li a')->each( function ($nodeInner) use ( &$array ,&$links, &$category ){
       			$array['category' ] = $category.'>'.$nodeInner->text();
       			//$array['link' ] = $nodeInner->extract(['href'])[0];
       				
       				$productsCrawler = Goutte::request( 'GET' , "https://morotai.com".$nodeInner->extract(['href'])[0] );

       				$productsCrawler->filter('.product-list > div')->each(function ($productsNode, $i) use (&$array ,&$links  ) {
       					if($i > 1 ){
       						return "";
       					}
       					if($productsNode->filter('a')->count() > 0 ){
       						if(strpos($productsNode->filter('a')->first()->extract(['href'])[0] , '/products/')){
       							//$array['product_link'] = $productsNode->filter('a')->first()->extract(['href'])[0];
       							
       							$productCrawl   = Goutte::request( 'GET' , "https://morotai.com".$productsNode->filter('a')->first()->extract(['href'])[0] );
       							$array['name']  = $productCrawl->filter('.font-bold.text-3xl.mt-5')->text(); 
       							$array['price'] = $productCrawl->filter(".leading-none.mt-4 span:not(.text-grey-dark)")->text();
       							$array['image'] = $productCrawl->filter(".product-single-image-full")->extract(['src'])[0];
       							

       							// $productCrawl->filter(".product-tabs:first-child .tab")->each(function ($nodePrdDetails) use (&$array , &$links ){
       							// 	$array[$nodePrdDetails->filter('h3')->text()] = $nodePrdDetails->filter('.content')->html()	;		
       								
       							// }); 
       							$links[]=$array;
       							
       						}

       						
       					}

       				});	


       		}); 
       }else{
       		if($node->filter('a')->text()  != "New products" && $node->filter('a')->text()  != "Vouchers" ){
	       		//$array['link' ] = $node->filter('a')->extract(['href'])[0];

	       		$productsCrawler = Goutte::request( 'GET' , "https://morotai.com".$node->extract(['href'])[0] );
	       		$productsCrawler->filter('.product-list > div')->each(function ($productsNode,$i) use (&$array ,&$links) {
	       				if($i > 1 ){
       						return "";
       					}
       					if($productsNode->filter('a')->count() > 0 ){
       						if(strpos($productsNode->filter('a')->first()->extract(['href'])[0] , '/products/')){
       							//$array['product_link'] = $productsNode->filter('a')->first()->extract(['href'])[0];
       							
       							$productCrawl   = Goutte::request( 'GET' , "https://morotai.com".$productsNode->filter('a')->first()->extract(['href'])[0] );
       							$array['name']  = $productCrawl->filter('.font-bold.text-3xl.mt-5')->text(); 
       							$array['price'] = $productCrawl->filter(".leading-none.mt-4 span:not(.text-grey-dark)")->text();
       							$array['image'] = $productCrawl->filter(".product-single-image-full")->extract(['src'])[0];
       							

       							// $productCrawl->filter(".product-tabs:first-child .tab")->each(function ($nodePrdDetails) use (&$array , &$links ){
       							// 	$array[$nodePrdDetails->filter('h3')->text()] = html_entities($nodePrdDetails->filter('.content')->html()	);		
       							// }); 
       							$links[]=$array;
       							
       						}

       						
       					}
       			});
	       		
       		}
       }
       //	
       
       
    });

   	return response()->json(['data' => $links]);
});
