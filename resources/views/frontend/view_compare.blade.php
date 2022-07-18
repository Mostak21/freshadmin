@extends('frontend.layouts.app')

@section('content')

<section class="productheaderbg py-5">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Compare')}}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('compare.reset') }}">{{ translate('Compare')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="mb-4">
    <div class="container text-left">
        <div class="bg-white shadow-sm rounded">
            <div class="p-3  d-flex justify-content-between align-items-center">
                <div class="fs-15 fw-600">{{ translate('')}}</div>
                <a href="{{ route('compare.reset') }}" style="text-decoration: none;"
                    class="btn btn-soft-primary btn-sm fw-600">{{ translate('Reset Compare List')}}
                </a>
            </div>
            @if(Session::has('compare'))
            @if(count(Session::get('compare')) > 0)
            <div class="p-3">
                <table class="table mb-0">
                    
                    <tbody class=" table-bordered ">
                        <tr>
                            <th scope="row"></th>
                            @foreach (Session::get('compare') as $key => $item)
                            <td class="text-center">
                                <img loading="lazy"
                                    src="{{ uploaded_asset(\App\Models\Product::find($item)->thumbnail_img) }}"
                                    alt="{{ translate('Product Image') }}" class="img-fluid py-4 h-150px">
                                <div>
                                    <a class="text-reset fs-14 fw-600"
                                        href="{{ route('product', \App\Models\Product::find($item)->slug) }}">
                                        {{ \App\Models\Product::find($item)->getTranslation('name') }}
                                    </a>
                                </div>
                                <div class="py-2">
                                    <button type="button" class="btn btn-primary btn-sm fw-600"
                                        onclick="showAddToCartModal({{ $item }})">
                                        {{ translate('Add to cart')}}
                                    </button>
                                </div>
                            </td>
                            @endforeach
                        </tr>
                        <tr class="bg-soft-secondary" style="border-top: 2px solid #070747">
                        <th scope="row" class="fw-600 fs-14">General</th>
                        @foreach (Session::get('compare') as $key => $item)
                            <td class="">
                                    <a class="text-reset  fw-600"
                                        href="{{ route('product', \App\Models\Product::find($item)->slug) }}">
                                        {{ \App\Models\Product::find($item)->getTranslation('name') }}
                                    </a>
                            </td>
                        @endforeach

                        </tr>
                        <tr>
                            <th scope="row" class="fs-14 fw-600">{{ translate('Price')}}</th>
                            @foreach (Session::get('compare') as $key => $item)
                            @php
                            $product = \App\Models\Product::find($item);
                            @endphp
                            <td>
                                @if(home_base_price($product) != home_discounted_base_price($product))
                                <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
                                @endif
                                <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="row" class="fs-14 fw-600">{{ translate('Brand')}}</th>
                            @foreach (Session::get('compare') as $key => $item)
                            <td>
                                @if (\App\Models\Product::find($item)->brand != null)
                                {{ \App\Models\Product::find($item)->brand->getTranslation('name') }}
                                @endif
                            </td>
                            @endforeach
                        </tr>
                       

                        @php

                        $a[]=null;  
                        foreach (Session::get('compare') as $key => $item){
                        if (\App\Models\Product::find($item)->choice_options != null){
                        
                        foreach (json_decode(\App\Models\Product::find($item)->choice_options) as $key => $choice){
                        array_push($a,"$choice->attribute_id");
                        }

                        }

                        }
                        @endphp 
						 <tr class="bg-soft-secondary" style="border-top: 2px solid #070747">
                            <th scope="row" class="fw-600 fs-14">Summary</th>
                            @foreach (Session::get('compare') as $key => $item)
                                <td class="">
                                        <a class="text-reset fw-600"
                                            href="{{ route('product', \App\Models\Product::find($item)->slug) }}">
                                            {{ \App\Models\Product::find($item)->getTranslation('name') }}
                                        </a>
                                </td>
                            @endforeach
    
                        </tr>
						
                        @foreach(array_unique($a) as $arr)
                        @if($arr!=null)
                        <tr> 
                        <th scope="row" class="fw-600 fs-14">{{ \App\Models\Attribute::find($arr)->getTranslation('name') }}</th>
   
                            @foreach (Session::get('compare') as $key => $item)
                                <td>  
                                  @if(\App\Models\Product::find($item)->choice_options != null)
                                  @foreach (json_decode(\App\Models\Product::find($item)->choice_options) as $key => $choice)
                                        @if($choice->attribute_id==$arr)
                                            @foreach($choice->values as $key => $value)
                                                {{$value}}
                                            @endforeach
                                        @endif
                                  @endforeach
                                  @endif  
                                </td>
                            @endforeach
                        </tr>
                        @endif
                        @endforeach


                        <tr>
                            <th scope="row"></th>
                            @foreach (Session::get('compare') as $key => $item)
                            <td class="text-center py-3">
                                <button type="button" class="btn btn-primary fw-600 w100 w-100"
                                    onclick="showAddToCartModal({{ $item }})">
                                    {{ translate('Add to cart')}}
                                </button>
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
            @else
            <div class="text-center p-4">
                <p class="fs-17">{{ translate('Your comparison list is empty')}}</p>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection