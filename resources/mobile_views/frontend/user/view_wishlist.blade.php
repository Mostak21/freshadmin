@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="rit-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <b class="h4">{{ translate('Wishlist')}}</b>
            </div>
        </div>
    </div>

    <div class="row gutters-5">
        @forelse ($wishlists as $key => $wishlist)
            @if ($wishlist->product != null)


            <div class="row no-gutters box-3 align-items-center  product-fullwidth" id="wishlist_{{ $wishlist->id }}">
                <div class="col-3">
                    <a href="" class="d-block p-2">
                        <img class=" p-img-round lazyload"
                            src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/3TnNLBsHYoEfQ5A4rcAzr9CzdDwezNqG1d6WZkQ6.svg"
                            data-src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" alt="{{  $wishlist->product->getTranslation('name')  }}"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                    </a>
                </div>

                <div class="col-9 pr-2">
                    <div class="px-2 text-left">
                        @if(!empty($wishlist->product->brand->name))
                        <span class="text-black fw-600">	 {{  $wishlist->product->brand->name }}</span>
                        @endif

                        <div class="fs-14 fw-500">
                            <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block text-reset">{{  $wishlist->product->getTranslation('name')  }}</a>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between  align-items-center ">
                        <div class="pl-2">
                            @if(home_base_price($wishlist->product) != home_discounted_base_price($wishlist->product))
                            <del class="opacity-60 mr-1">{{ home_base_price($wishlist->product) }}</del>
                                @endif
                            <span class="fw-600 text-primary ">{{ home_discounted_base_price($wishlist->product) }}</span>
                        </div>

                        <div class="p-1">
                            <button type="button" class="btn btn-sm rounded-custom btn-dark fs-14 px-2 py-1" onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                <b><i class="ci-cart"></i></b>
                            </button>
                            <button type="button" class="btn btn-sm rounded-custom btn-dark fs-14 px-2 py-1" onclick="removeFromWishlist({{ $wishlist->id }})">
                                <b><i class="ci-trash"></i></b>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            {{--
                <div class="col-xxl-3 col-xl-4 col-lg-3 col-md-4 col-sm-6" id="wishlist_{{ $wishlist->id }}">
                    <div class="card mb-2 shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block mb-3">
                                <img src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" class="img-fit h-140px h-md-200px">
                            </a>

                            <h5 class="fs-14 mb-0 lh-1-5 fw-600 text-truncate-2">
                                <a href="{{ route('product', $wishlist->product->slug) }}" class="text-reset">{{ $wishlist->product->getTranslation('name') }}</a>
                            </h5>
                            <div class="rating rating-sm mb-1">
                                {{ renderStarRating($wishlist->product->rating) }}
                            </div>
                            <div class=" fs-14">
                                  @if(home_base_price($wishlist->product) != home_discounted_base_price($wishlist->product))
                                      <del class="opacity-60 mr-1">{{ home_base_price($wishlist->product) }}</del>
                                  @endif
                                      <span class="fw-600 text-primary">{{ home_discounted_base_price($wishlist->product) }}</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">
                                <i class="la la-trash la-2x"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-block btn-primary ml-3" onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                <i class="la la-shopping-cart mr-2"></i>{{ translate('Add to cart')}}
                            </button>
                        </div>
                    </div>
                </div>--}}
            @elseif($wishlist->product == null && $wishlist->product_id)
                <button type="button" class="btn btn-sm rounded-custom btn-dark fs-14 px-2 py-1" id="wishlist_{{ $wishlist->id }}" onclick="removeFromWishlist({{ $wishlist->id }})">
                    <b><i class="ci-trash"></i></b>
                </button>
            @endif
        @empty
            <div class="col">
                <div class="text-center bg-white p-4 rounded shadow">
                    <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                    <h5 class="mb-0 h5 mt-3">{{ translate("There isn't anything added yet")}}</h5>
                </div>
            </div>
        @endforelse
    </div>
    <div class="rit-pagination">
        {{ $wishlists->links() }}
    </div>
@endsection

@section('modal')

<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="c-preloader">
                <i class="fa fa-spin fa-spinner"></i>
            </div>
            <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div id="addToCart-modal-body">

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                RIT.plugins.notify('success', '{{ translate('Item has been renoved from wishlist') }}');
            })
        }
    </script>
@endsection
