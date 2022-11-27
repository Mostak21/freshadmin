@if (get_setting('home_slider_images') != null)
    <div class="rit-carousel dots-inside-bottom mobile-img-auto-height rounded-slider" data-dots="true" data-autoplay="true">
        @php
            //$slider_images = json_decode(get_setting('home_slider_images'), true);
            $featured_categories = Cache::get('featured_categories')??null;
            $slider_images = Cache::rememberForever('home_slider_images', function () {
                $slider_images = json_decode(get_setting('home_slider_images'), true);
                foreach ($slider_images as $key => $value){
                    $images[$key] = uploaded_asset($value);
                }
                return $images;
            });
        @endphp
        @foreach ($slider_images as $key => $value)
            <div class="carousel-box">
                <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                    <img
                        class="d-block mw-100 img-fit rounded-slider overflow-hidden"
                        src="{{ $value }}"
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
