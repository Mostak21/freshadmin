<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Utility\CategoryUtility;

class DropdownCategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'name' => $data->getTranslation('name'),
                    'm_bg' => api_asset($data->m_bg),
                    'm_image' => api_asset($data->m_image),
                    'm_slogan' => $data->m_slogan,
                    'm_color' => $data->m_color,
                    'banner' => api_asset($data->banner),					
                    'number_of_children' => CategoryUtility::get_immediate_children_count($data->id),
                    'links' => [
                        'products' => route('api.products.category', $data->id),
                        'sub_categories' => route('subCategories.index', $data->id)
                    ],
                    'subcategory'=> new SubCategoryCollection($data->Categories)

                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
