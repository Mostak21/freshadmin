<a href="{{ route('wishlists.index') }}" class="d-flex align-items-center text-reset">

   <b><i class="navbar-tool ci-heart fs-22  la-2x"></i></b>
 <span class="flex-grow-1 ml-1">
        @if(Auth::check() && count(Auth::user()->wishlists) >0 )
         <i class="red-dot opacity-80 " ></i>
{{--            <span class="badge badge-primary badge-inline badge-pill">{{ count(Auth::user()->wishlists)}}</span>--}}
{{--        @else--}}
{{--            <span class="badge badge-primary badge-inline badge-pill">0</span>--}}
        @endif
{{--        <span class="nav-box-text d-none d-xl-block ">{{translate('Wishlist')}}</span>--}}
    </span>
</a>


@if($data??0)
    @php
        $data = \App\Product::where('id', $data)->first();
    @endphp
    <script type = "text/javascript">
        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
            event: "add_to_wishlist",
            @php
                $item_category = category_tree($data->category->id);
            @endphp
            ecommerce: {
                items: [
                    {
                        item_id:{!! $data->id!!},
                        item_name: "{!! $data->name!!}",
                        affiliation: "Google Merchandise Store",
                        coupon: "SUMMER_FUN",
                        currency: "BDT",
                        discount: {{number_format((float)$data->discount, 2, '.', '')??0.00}},
                        index: 0,
                        item_brand: "{{$data->brand->name??""}}",
                        item_category: "{!! $item_category[0]??"" !!}",
                        item_category2: "{!! $item_category[1]??"" !!}",
                        item_category3: "{!! $item_category[2]??"" !!}",
                        item_category4: "",
                        item_category5: "",
                        item_list_id: "",
                        item_list_name: "",
                        item_variant: "",
                        location_id: "",
                        price: {{number_format((float)$data->unit_price, 2, '.', '')??0.00}},
                        quantity: 1
                    }
                ]
            }
        });
    </script>
@endif
