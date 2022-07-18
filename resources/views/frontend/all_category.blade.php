@extends('frontend.layouts.app')

@section('content')
<section class="d-none d-lg-block">
    <div class="productheaderbg py-5">
        <div class="container d-lg-center">
            <div class="row ">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="h3 fw-600">
                        {{ translate('All Categories') }}
                    </h1>
                  
                </div>
                <div class="col-lg-6 fs-13">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item ">
                            
                            <a class="text-reset" href="{{ route('home') }}"> <i class="fa fa-home"></i> {{ translate('Home')}}</a>
                        </li>
                        <li class="text-dark  breadcrumb-item">
                            <a class="text-reset" href="{{ route('categories.all') }}">{{ translate('All Categories') }}</a>
                        </li>
                    </ul>
                </div>
            </div>    
        </div>
    </div>
</section>
<section class="mb-4 d-none d-lg-block">
    <div class="container">
        @foreach ($categories as $key => $category)
            <div class="mb-3 bg-white ">
                
                <div class="mt-2 mb-3 text-center">
                    <h3 class="h5 fw-700 mb-0">
                        <a href="{{ route('products.category', $category->slug) }}">  <span class=" px-2 py-2 bg-white c-pointer has-transition">{{  $category->getTranslation('name') }}</span></a>
                    </h3>
                </div>
                <div class="p-3 p-lg-4">
                    <div class="row">
                    @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                        <div class="col-lg-4 col-6 text-left">
                            <a class="text-reset fw-600 fs-18" href="{{ route('products.category', \App\Models\Category::find($first_level_id)->slug) }}"> 
                               @php
                                   $p = \App\Models\Category::find($first_level_id);
                               @endphp
                               
                                <img class="w-100 rounded lazyload" src="https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/5ABazMntewtJzb87ssoHZmo5utCeJqwxdmLMgWva.png"
                                 data-src="{{ uploaded_asset($p->banner) }}"

                                 onerror="this.onerror=null;this.src='https://brandhook.s3.ap-south-1.amazonaws.com/uploads/all/5ABazMntewtJzb87ssoHZmo5utCeJqwxdmLMgWva.png';"/></a>



                            <h6 class="mb-3 mt-2"><a class="text-reset fw-600 fs-18" href="{{ route('products.category', \App\Models\Category::find($first_level_id)->slug) }}">{{ \App\Models\Category::find($first_level_id)->getTranslation('name') }}</a></h6>
                            <ul class="mb-3 list-unstyled pl-2">
                                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                                    
                                    @if($loop->iteration<10)
                                    <li class="mb-2">
                                        <i class="fa fa-chevron-circle-right"></i> <a class="text-reset" href="{{ route('products.category', \App\Models\Category::find($second_level_id)->slug) }}" >{{ \App\Models\Category::find($second_level_id)->getTranslation('name') }}</a>
                                    </li>
                                    @endif

                                    @if($loop->iteration==10)
                                    <li class="mb-2">
                                        <i class="fa fa-chevron-circle-right"></i> <a class="text-reset" href="{{ route('products.category', \App\Models\Category::find($second_level_id)->slug) }}" >{{ \App\Models\Category::find($second_level_id)->getTranslation('name') }}</a>
                                    </li>
                                        <li class="mb-2 text-primary c-pointer" onclick="collapsecat('{{$second_level_id}}') ">
                                            <i class="fa fa-chevron-circle-right"></i> View More
                                        </li>
                                        <span class="d-none bg-gray" id="catcollapse{{$second_level_id}}">
                                    @endif
                                    
                                    
                                    
                                    @if($loop->iteration>10)
                                    
                                        <li class="mb-2">
                                            <i class="fa fa-chevron-circle-right"></i> <a class="text-reset" href="{{ route('products.category', \App\Models\Category::find($second_level_id)->slug) }}" >{{ \App\Models\Category::find($second_level_id)->getTranslation('name') }}</a>
                                        </li>
                                    @endif
                                
                                    
                                @endforeach
                                </span>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="d-lg-none">
	
	
	 <div class="row">
        <div class="col-md-5 mx-auto" >  
        @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11) as $key => $category)
               
        <div class="" style="background-image: url('{{ uploaded_asset($category->m_bg) }}');
        border-bottom:solid #FAFAFA 3px;
            ">
        <div class=""  onClick="mainmenu({!! $category->id!!})"
                  
                style="background: {{$category->m_color}}"
                >
                <div class="row">
                <div class="col-8  py-4"> 
                  <div class="px-3">
                    <h4>{{$category->name}}</h4>
                    <div class="fs-14"> {{$category->m_slogan}}</div>
                 </div>
                </div>
                <div class="col-4"> 
                     <div class="px-3 py-4 mparent" style="height: 100%;"> 
                    <div class="mchild">
                        <a class="mt-auto">
                          @if($category->m_image)  <img class="d-block w-100" src="{{ uploaded_asset($category->m_image) }}" height="100px" alt="For Women">@endif
                        </a>
                    </div>
                </div>
                </div>
                    
                 </div></div></div>
                <div id='grow{!! $category->id!!}' style=" -moz-transition: height .5s;
                    -ms-transition: height .5s;
                    -o-transition: height .5s;
                    -webkit-transition: height .5s;
                    transition: height .5s;
                    height: 0;
                    overflow: hidden;
                    position: relative;">
                    <div class='measuringWrapper{!! $category->id!!}'>
                <div class=" grow  " id="submenu{!! $category->id!!}"> 
                    @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                            <div class="p-2 pl-3" style="background-color: #FAFAFA;"   onClick="subsubmenu({!! \App\Models\Category::find($first_level_id)->id!!},{!! $category->id!!})">
                              <div class="d-flex justify-content-between">
                                  <div>
                                                                       <a class="text-reset hov-text-primary " href="{{ route('products.category', \App\Models\Category::find($first_level_id)->slug) }}">{{ \App\Models\Category::find($first_level_id)->getTranslation('name') }}</a>

                                  </div>
                                  <div class="pr-3 fs-10 fw-600">
                                    <i class="fa-solid fa-angle-down"></i>
                                  </div>
                                  </div>  
                            </div>
                            <div id='grow{!! \App\Models\Category::find($first_level_id)->id!!}' style=" -moz-transition: height .5s;
                                -ms-transition: height .5s;
                                -o-transition: height .5s;
                                -webkit-transition: height .5s;
                                transition: height .5s;
                                height: 0;
                                overflow: hidden;
                                position: relative;">
                                <div class='measuringWrapper{!! \App\Models\Category::find($first_level_id)->id!!}'>
                            <div class="ml-3 subsubmenu" id="subsubmenu{!! \App\Models\Category::find($first_level_id)->id!!}">
                                 @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                               <div class="px-3 py-2 bg-white">
                                    <a class="text-reset hov-text-primary " href="{{ route('products.category', \App\Models\Category::find($second_level_id)->slug) }}">{{ \App\Models\Category::find($second_level_id)->getTranslation('name') }}</a>
                                </div> 
                                 @endforeach
                            
                            </div>  </div></div>
                    @endforeach
                </div></div></div>
        @endforeach
    </div></div>
	
   <script>
      function subsubmenu(id,catid){
                         

                          
                               
                                var growDiv = document.getElementById('grow'+id);
                                
                                if (growDiv.clientHeight) {                               
                                 var wrapper = document.querySelector('.measuringWrapper'+id);
                                 var growDiv1 = document.getElementById('grow'+catid);
                                 var wrapper1 = document.querySelector('.measuringWrapper'+catid); 
                                 let str =  growDiv1.style.height; 
                                 let res = str.replace('px', '');
                                 growDiv1.style.height = (res-wrapper.clientHeight) + 'px';
                                 growDiv.style.height = 0;
                                 growDiv.classList.remove('mystyle');

                                } else {
                                 
                                  if(document.getElementsByClassName('mystyle').length!==0){
                                    var hello =document.getElementsByClassName('mystyle');

                                    for(var i=0; i< hello.length; i++){
                                      var growDiv1 = document.getElementById('grow'+catid);
                                       var wrapper1 = document.querySelector('.measuringWrapper'+catid);
                                       let str =  growDiv1.style.height; 
                                       let res = str.replace('px', ''); 
                                       let str1 = hello[i].style["height"];
                                       let res1 = str1.replace('px', ''); 
                                       growDiv1.style.height = 'auto';

                                        console.log(res);
                                        console.log(res1);
                                        console.log(growDiv1.style.height);
                                      hello[i].style["height"] = 0;

                                              }                                     
                                  };

                                  var wrapper = document.querySelector('.measuringWrapper'+id);
                                  growDiv.style.height = wrapper.clientHeight + 'px';
                                  var growDiv1 = document.getElementById('grow'+catid);
                                  var wrapper1 = document.querySelector('.measuringWrapper'+catid); 
                                  growDiv1.style.height = 'auto';
                                 // growDiv1.style.height = (wrapper.clientHeight+wrapper1.clientHeight) + 'px';
                                  growDiv.classList.add('mystyle');
                                  

                                }
                                

                                
                                
     
                            } 


    function mainmenu(catid){

        var growDiv = document.getElementById('grow'+catid);
                    if (growDiv.clientHeight) {
                      growDiv.style.height = 0;
                      growDiv.classList.remove('mystylemain');
                    } else {
                        var hello =document.getElementsByClassName('mystylemain');

                                    for(var i=0; i< hello.length; i++){
                                     
                                      hello[i].style["height"] = 0;

                                              }                                     

                      var wrapper = document.querySelector('.measuringWrapper'+catid);
                      growDiv.style.height = wrapper.clientHeight + 'px';
                      var sicon = document.getElementById('icon'+catid);
                      growDiv.classList.add('mystylemain');
                    }


    }
        


    </script>	
	
</section	

@endsection
