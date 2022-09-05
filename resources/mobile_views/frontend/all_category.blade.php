@extends('frontend.layouts.app')

@section('content')


<section class="">
	
	
	 <div class="container-custom mb-5">
    
        @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11);
       as $key => $category)
               
        <div class="cat-mobile mb-2 rounded-custom overflow-hidden" style="background-image: url('{{ uploaded_asset($category->m_bg) }}'); background-size: cover;
          background-repeat: no-repeat;
          background-position: center ;
            ">
        <div class=""  onClick="mainmenu({!! $category->id!!})"
                  
                {{-- style="background: {{$category->m_color}}" --}}
                >
                <div class="row m-0">
                <div class="col-12 p-0"> 
                  <div class="px-3 py-4">
                    <h4>{{$category->name}}</h4>
                    <div class="fs-14"> {{$category->m_slogan}}</div>
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
                
         
                    @foreach (
                     \App\Utility\CategoryUtility::get_immediate_children_ids($category->id);
                   as $key => $first_level_id)
                            <div class="p-2 pl-3" style="background-color: #FAFAFA;"   onClick="subsubmenu({!! \App\Models\Category::find($first_level_id)->id!!},{!! $category->id!!})">
                              <div class="d-flex justify-content-between">
                                  <div>
                                                                       <a class="text-reset hov-text-primary " href="{{ route('products.category', \App\Models\Category::find($first_level_id)->slug) }}">{{ \App\Models\Category::find($first_level_id)->name }}</a>

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
                              
                              
                                 @foreach ( 
                                 \App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id);
                             as $key => $second_level_id)
                               <div class="px-3 py-2 bg-white">
                                    <a class="text-reset hov-text-primary " href="{{ route('products.category', \App\Models\Category::find($second_level_id)->slug) }}">{{ \App\Models\Category::find($second_level_id)->name }}</a>
                                </div> 
                                 @endforeach
                            
                            </div>  </div></div>
                    @endforeach
                </div></div></div>
        @endforeach
    </div>
		
</section>	
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


@endsection
