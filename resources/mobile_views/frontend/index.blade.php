@extends('frontend.layouts.app')

@section('content')
<div class="container mb-2">
<div class="w100 rounded-slider">
    @if (get_setting('home_slider_images') != null)
        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height " data-dots="true" data-autoplay="true">
            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
            @foreach ($slider_images as $key => $value)
                <div class="carousel-box rounded-slider">
                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                        <img
                            class="d-block mw-100 img-fit rounded-slider shadow-sm overflow-hidden"
                            src="{{ uploaded_asset($slider_images[$key]) }}"
                            alt="{{ env('APP_NAME')}} promo"
                            @if(count($featured_categories) == 0)
                            height="auto"
                            @else
                            height="auto"
                            @endif
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                        >
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>
</div>
<div id="section_home_categories">

</div>


<div id="section_best_selling">

</div>

    
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.custom_section') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#custom_section').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
@endsection
