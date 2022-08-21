@php
    $Product_Stock = 0 ;
    if($product->productData != null)
    $Product_Stock = $product->productData->stock;
    else
    if (!empty($product->stocks)) foreach ($product->stocks as $stock) if ($stock->qty>=1) $Product_Stock = 1;
@endphp

<div class="row no-gutters  box-3 align-items-center  product-fullwidth">
  
    <div class="col-3">
        <a href="" class="d-block p-2">
            <img class=" p-img-round lazyload"
                 src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3TnNLBsHYoEfQ5A4rcAzr9CzdDwezNqG1d6WZkQ6.svg"
                 data-src="{{$product->productData->thumbnail?? uploaded_asset($product->thumbnail_img) }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
        </a>
    </div>
    <div class="col-6 ">
        <div class="p-2 text-left">

            <span class="text-black fw-600">{{ $product->productData->brand??$product->brand->name??""}}</span>

    
            <div class="fs-14 fw-500 text-truncate">
                <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{  $product->getTranslation('name')  }}</a>

            </div>
            <div class="rating rating-sm ">
                {{ renderStarRating($product->rating) }}
            </div>


        </div>
    </div>
    <div class="col-3">

          {{-- @if ($product->unit_price > 5000 && ($product->unit_price-$product->discount)>= 5000)
                 <div class="bg-dark rounded-custom"><span>EMI</span></div> 
          @endif --}}
    
          @if (!$Product_Stock)
          <div class="text-right mb-1 pr-3"><span class="rounded-sm px-2 py-1 " style="background-color: black; color:aliceblue;"><small>Sold Out</small></span></div>
          
          @else
          @if ($product->unit_price > 5000 && ($product->unit_price-$product->discount)>= 5000)
          <div class="text-right mb-1 pr-3"><span class="rounded-sm px-2 py-1 " style="background-color: rgb(189, 18, 18); color:aliceblue;"><small>EMI</small></span></div>

          @endif
          @endif


        <div class="fs-15 text-right pr-3">
            <div class="fw-600"> <a class=" text-black"href="{{ route('product', $product->slug) }}">{{ home_discounted_base_price($product) }}</a></div>
            @if(home_base_price($product) != home_discounted_base_price($product))
                <del class="fw-400 mr-1 fs-12">{{ home_base_price($product) }}</del>
            @endif
        </div>

    </div>
</div>
