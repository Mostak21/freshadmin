<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Shop;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Page;
use Artisan;
use Cache;
use CoreComponentRepository;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard(Request $request)
    {   
        CoreComponentRepository::initializeCache();
        $root_categories = Category::where('level', 0)->get();

        $cached_graph_data = Cache::remember('cached_graph_data', 86400, function() use ($root_categories){
            $num_of_sale_data = null;
            $qty_data = null;
            foreach ($root_categories as $key => $category){
                $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);
                $category_ids[] = $category->id;

                $products = Product::with('stocks')->whereIn('category_id', $category_ids)->get();
                $qty = 0;
                $sale = 0;
                foreach ($products as $key => $product) {
                    $sale += $product->num_of_sale;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                }
                $qty_data .= $qty.',';
                $num_of_sale_data .= $sale.',';
            }
            $item['num_of_sale_data'] = $num_of_sale_data;
            $item['qty_data'] = $qty_data;

            return $item;
        });

        return view('backend.dashboard', compact('root_categories', 'cached_graph_data'));
    }
	
	
	function notemodal(Request $request)
    {
        $order=Order::find($request->id);
        return view('backend.sales.all_orders.notemodal',compact('order'));
    }

    function notestore(Request $request){
        
        $order= Order::find($request->id);
        $order->communication_status=$request->communication_status;
        $order->communication_note=$request->communication_note;
        $order->save();

        flash(translate('Note been stored successfully'))->success();
        return back();
    }
	

    function sitemap(){
        
    // create new sitemap object
    $sitemap = App::make("sitemap");
    $todaysdate= date('Y-m-d H:i:s');
   
    // add items to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to('/'), $todaysdate, '1.0', 'daily');
    $sitemap->add(URL::to('/sellers'), $todaysdate, '0.6', 'daily');
    $sitemap->add(URL::to('/blog'), $todaysdate, '0.6', 'daily');
    $sitemap->add(URL::to('/brands'), $todaysdate, '0.6', 'daily');
    $sitemap->add(URL::to('/users/login'), $todaysdate, '0.6', 'daily');
    $sitemap->add(URL::to('/users/registration'), $todaysdate, '0.6', 'daily');
    $sitemap->add(URL::to('/users/track-your-order'), $todaysdate, '0.6', 'daily');
    $sitemap->add(URL::to('/shops/create'), $todaysdate, '0.6', 'daily');
   

    $products= Product::where('published',1)->get();
    $pages=Page::all();
    $brands= Brand::all();
    $shops= Shop::all();
    $categories=Category::all();
    $blogs=Blog::where('status',1)->get();
    $blogcategories=BlogCategory::all();
    foreach ($products as $product) {
        $sitemap->add(Url::to("/product/{$product->slug}"), $product->updated_at, '0.7', 'daily');
    }
    
    foreach ($pages as $page) {
        $sitemap->add(Url::to("/{$page->slug}"), $page->updated_at, '0.8', 'daily');
    }
    foreach ($brands as $brand) {
        $sitemap->add(Url::to("/brand/{$brand->slug}"), $todaysdate, '0.8', 'daily');
    }
    foreach ($shops as $shop) {
        $sitemap->add(Url::to("/shop/{$shop->slug}"), $todaysdate, '0.8', 'daily');
    }
    foreach ($categories as $category) {
        if($category->level==0)
        $sitemap->add(Url::to("/category/{$category->slug}"), $todaysdate, '0.9', 'daily');
        elseif($category->level==1)
        $sitemap->add(Url::to("/category/{$category->slug}"), $todaysdate, '0.8', 'daily');
        else
        $sitemap->add(Url::to("/category/{$category->slug}"), $todaysdate, '0.7', 'daily');
    }
    foreach ($blogs as $blog) {
        $sitemap->add(Url::to("/blog/{$blog->slug}"), $blog->updated_at, '0.7', 'daily');
    }
    foreach ($blogcategories as $category) {
        $sitemap->add(Url::to("/blog/category/{$category->slug}"), $category->updated_at, '0.8', 'daily');
    }

    // // get all posts from db
    // $categories = Category::all();

    // // add every post to the sitemap
    // foreach ($categories as $category)
    // {
    //     $sitemap->add(URL::to('categories/'.$category->id.'/edit'), $category->updated_at, '1.0', 'daily');
    // }

    // generate your sitemap (format, filename)
    $sitemap->store('xml', 'sitemap',base_path());
    // this will generate file mysitemap.xml to your public folder
    flash(translate('Sucessfully generate sitemap'))->success();
        return back();

    }





    function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        flash(translate('Cache cleared successfully'))->success();
        return back();
    }
}
