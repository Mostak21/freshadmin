
@php
    $categories = Cache::remember('main_categories',86400, function () {
                $categories = \App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11);
                foreach ($categories as $key => $category){
                    $category->icon_link=uploaded_asset($category->icon);
                    $category->children=count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id));
                    $main_categories[$key] = $category;
                }
                return collect($main_categories);
            });
@endphp

<div onmouseout="categoryhoverMouseout(this)" onmouseover="categoryhoverMouseover(this)" class="aiz-category-menu bg-white rounded @if(Route::currentRouteName() == 'home') shadow-sm" @else shadow-lg" id="category-sidebar" @endif  style="border-radius: 0 0 10px 10px !important; border-top: solid 2px var(--primary);">
<ul class="list-unstyled categories no-scrollbar py-2 mb-0 text-left">
    @foreach ($categories as $key => $category)
        <li class="category-nav-element" data-id="{{ $category->id }}">
            <a href="{{ route('products.category', $category->slug) }}" class="text-truncate text-reset py-2 px-3 d-block">
                <img
                    class="cat-image lazyload mr-2 opacity-60"
                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
{{--                    data-src="{{ uploaded_asset($category->icon) }}"--}}
                    data-src="{{ $category->icon_link }}"
                    width="16"
                    alt="{{ $category->name }}"
                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                >
                <span class="cat-name">{{ $category->name }}</span>
            </a>
            @if($category->children>0)

              <div class="sub-cat-menu bg-transparent" style="width: calc(100% - 40%);">
                  <div class="sub-cat-menu rounded bg-white shadow-lg p-4 c-scrollbar-light" style="left: calc(2%); height: calc(96%); border-radius: 0 0 10px 10px !important; border-top: solid 2px var(--primary); width: auto;">
                      <div class="c-scrollbar-light bg-white">
                          <div class="card-columns">

                              <div class="c-preloader text-center absolute-center">
                                  <i class="las la-spinner la-spin la-3x opacity-70"></i>
                              </div>
                          </div>
                      </div>

                  </div>
{{--                    <div class="c-preloader text-center absolute-center">--}}
{{--                        <i class="las la-spinner la-spin la-3x opacity-70"></i>--}}
{{--                    </div>--}}
                </div>

            @endif
        </li>
    @endforeach
</ul>
</div>






{{-- <div class="aiz-category-menu  rounded @if(Route::currentRouteName() == 'home') shadow-sm" @else shadow-lg" id="category-sidebar" @endif>

    <div class="mnav">
        <div class="cnav">

            <ul class="menu menu-bar">
                <li class="">

                    <ul class="mmega-menu mmega-menu--multiLevel">

                    @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11) as $key => $category)
                        <li class="py-1 border" style="margin: 2px;">

                            <a href="{{ route('products.category', $category->slug) }}" class="menu-link mmega-menu-link" aria-haspopup="true">
                                  <img
                        class="cat-image lazyload mr-2 opacity-60"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($category->icon) }}"
                        width="16"
                        alt="{{ $category->getTranslation('name') }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                    > {{ $category->getTranslation('name') }}</a>


                        @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                            <ul class="menu menu-list">


                                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                                <li class="py-1 border" style="margin: 2px;">
                                    <a href="{{ route('products.category', \App\Models\Category::find($first_level_id)->slug) }}" class="menu-link menu-list-link"
                                        aria-haspopup="true"> {{ \App\Models\Category::find($first_level_id)->getTranslation('name') }}</a>
                                        @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id))>0)
                                   <ul class="menu menu-list" style=" overflow: scroll;
                                    overflow-x: hidden;">
                                        @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                                        <li class="py-1 border" style="margin: 2px;">
                                            <a href="{{ route('products.category', \App\Models\Category::find($second_level_id)->slug) }}" class="menu-link menu-list-link">{{ \App\Models\Category::find($second_level_id)->getTranslation('name') }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                                @endforeach

                            </ul>
                        @endif
                        </li>
                @endforeach
                    </ul>
                </li>

                <li>

            </ul>
        </nav>
    </div>
    </div>
</div>
 --}}
