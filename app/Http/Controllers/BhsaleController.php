<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Utility\CategoryUtility;

class BhsaleController extends Controller{

    public function index(){
       
        $smartwatchs= getsaleproduct('90','smartwatch2023');
        $musics= getsaleproduct('92','music2023');
        $sounds= getsaleproduct('92','sounds2023');
        $powerbanks= getsaleproduct('377','powerbanks2023');
        $fragrances= getsaleproduct('61','Fragrance2023');
        $smartvs= getsaleproduct('627','tvaccessories2023');
        
        
        return view('frontend.sale', compact('smartwatchs','musics','sounds','powerbanks','fragrances','smartvs'));
    }

}