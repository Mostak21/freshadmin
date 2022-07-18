<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExportGoogleSingleBrandv2 implements FromCollection, WithMapping, WithHeadings
{
	function getbrand(){
		return session('id_ha12gf11h');
	}

    public function collection()
    {
		$id = $this->getbrand();
        //return Product::all();
		return Product::where('brand_id',$id)->get();
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
            'google_product_category',
            'fb_product_category',
            'quantity_to_sell_on_facebook',
            'sale_price',
            'sale_price_effective_date',
			'item_group_id',
			'gender',
			'color',
			'size',
			'age_group',
			'material',
			'pattern',
			'shipping',
			'shipping_weight'
			
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
        return [
            $product->id,
            $product->name,
            $product->meta_description,
			"in_stock",
			"New",
			"BDT ".$product->unit_price,
            "https://brandhook.com.bd/product/".$product->slug,
			uploaded_asset($product->photos),
			$product_brand_name,
			 $product->category->g_cat,
             $product->category->f_cat,
			"",
			"BDT ".($product->unit_price-$product->discount),
			"2022-03-13T12:59+06:00/2022-12-13T12:59+06:00",
			"",
			"unisex",
			"",
			"",
			"adult",
			"",
			"",
			"",
			"",

        ];
    }
}
