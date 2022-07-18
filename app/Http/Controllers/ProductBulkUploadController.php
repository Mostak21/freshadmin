<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\User;
use Auth;
use App\Models\ProductsImport;
use App\Models\ProductsExport;
use App\Models\ProductsExportGoogle;
use App\Models\ProductsExportFacebook;
use App\Models\ProductsExportFacebookSingleBrand;
use App\Models\ProductsExportGoogleSingleBrandv2;
use PDF;
use Excel;
use Illuminate\Support\Str;

class ProductBulkUploadController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.user.seller.product_bulk_upload.index');
        }
        elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('backend.product.bulk_upload.index');
        }
    }

    public function export(){
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    
    
     public function export_google(){
        return Excel::download(new ProductsExportGoogle, 'productsGoogle.xlsx');
    }
	 public function export_facebook(){
        return Excel::download(new ProductsExportFacebook, 'ProductsFacebook.xlsx');
    }

    public function export_brand(Request $request){
        $sort_search =null;
        $brands = Brand::orderBy('name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $brands = $brands->where('name', 'like', '%'.$sort_search.'%');
        }
        $brands = $brands->paginate(15);
        return view('backend.product.brands.export', compact('brands', 'sort_search'));
    }

    public function export_single_brand(Request $id){
        $idn = $id->input('id');
        $id->session()->flash('id_ha12gf11h',$idn);
        $singleBrand = new ProductsExportGoogleSingleBrandv2;
        return Excel::download($singleBrand, 'productsGoogleSingleBrand.xlsx');
    }
	
	 public function export_single_brand_fb(Request $id){
        $idn = $id->input('id');
        $id->session()->flash('id_ha12gf11h',$idn);
        $singleBrand = new ProductsExportFacebookSingleBrand;
        return Excel::download($singleBrand, 'productsfacebookSingleBrand.xlsx');
    }
    
    

    public function pdf_download_category()
    {
        $categories = Category::all();

        return PDF::loadView('backend.downloads.category',[
            'categories' => $categories,
        ], [], [])->download('category.pdf');
    }

    public function pdf_download_brand()
    {
        $brands = Brand::all();

        return PDF::loadView('backend.downloads.brand',[
            'brands' => $brands,
        ], [], [])->download('brands.pdf');
    }

    public function pdf_download_seller()
    {
        $users = User::where('user_type','seller')->get();

        return PDF::loadView('backend.downloads.user',[
            'users' => $users,
        ], [], [])->download('user.pdf');

    }

    public function bulk_upload(Request $request)
    {
        if($request->hasFile('bulk_file')){
            $import = new ProductsImport;
            Excel::import($import, request()->file('bulk_file'));
            
            if(\App\Models\Addon::where('unique_identifier', 'seller_subscription')->first() != null && 
                    \App\Models\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                $seller = Auth::user()->seller;
                $seller->remaining_uploads -= $import->getRowCount();
                $seller->save();
            }
//            dd('Row count: ' . $import->getRowCount());
        }
        
        
        return back();
    }

}
