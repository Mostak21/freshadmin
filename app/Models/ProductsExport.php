<?php

namespace App\Models;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Product::where('published',1)->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'id',
            'user_id',
            'category_id',
			'category_L1',
            'category_L2',
            'category_L3',
            'brand_id',
            'video_provider',
            'video_link',
            'unit_price',
            'purchase_price',
            'unit',
            'current_stock',
            'meta_title',
            'meta_description',
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
		
		  $item_category = category_tree($product->category_id);
        if(empty($item_category[2])){
            $item_category[2]=0;
        }
        if(empty($item_category[1])){
            $item_category[1]=0;
        }
        return [
            $product->name,
            $product->id,
            $product->user_id,
            $product->category_id,
			$item_category[0],
            $item_category[1],
            $item_category[2],
            $product->brand_id,
            $product->video_provider,
            $product->video_link,
            $product->unit_price,
            $product->purchase_price,
            $product->unit,
//          $product->current_stock,
            $qty,
			$product->meta_title,
            $product->meta_description,
        ];
    }
}
