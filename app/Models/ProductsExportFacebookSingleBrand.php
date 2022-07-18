<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExportFacebookSingleBrand implements FromCollection, WithMapping, WithHeadings
{
	function getbrand(){
		return session('id_ha12gf11h');
	}

    public function collection()
    {
		$id = $this->getbrand();
        //return Product::all();
		return Product::where('brand_id',$id)->where('published',1)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'title',
            'description',
            'availability',
            'condition',
            'price',
            'link',
            'image link',
            'brand',
            'google product category',
            'fb_product_category',
            'quantity_to_sell_on_facebook',
			'sale_price',
            'sale_price_effective_date',
            'item_group_id',
            'color',
            
        
        ];
    }

    /**
    * @var Product $product
    */
    public function map($product): array
    {
        $qty = 0;
        foreach ($product->stocks as $key => $stock) {
            $qty += $stock->qty;
        }
		if(!empty($product->brand->name)){$product_brand_name=$product->brand->name;}
		else{$product_brand_name="NULL";}

        if(!empty($product->colors))
        { $color_name []= null;
            foreach(json_decode($product->colors) as $key => $color){
                $color_name[$key]=\App\Models\Color::where('code', $color)->first()->name;
                
            }
            $color_list= implode(",",$color_name);
        }

		else{$color_list="NULL";}
        
        $soldout="In Stock";
        $stock=\App\Models\ProductStock::where('product_id',$product->id)->first();
        //return $stock->qty;
        if(empty($stock)){
            $soldout= "out of stock";
			$stocknum= "0";
         }
       if(!empty($stock)){
            $stocknum=$stock->qty;
              if($stock->qty==0){
				$stocknum= "0";
                $soldout="out of stock";
                    }
         }
        
    

        return [
         	$product->id,
            $product->name,
            $product->meta_description,
            $soldout,
            "New",
            "BDT ".$product->unit_price,
            "https://brandhook.com.bd/product/".$product->slug,
			uploaded_asset($product->photos),
			$product_brand_name,
			$product->category->g_cat,
            $product->category->f_cat,
            $stocknum,
			"BDT ".($product->unit_price-$product->discount),
			"2022-03-13T12:59+06:00/2022-12-13T12:59+06:00",
            "",
            $color_list,
            
         
        ];
    }
}
