@extends('frontend.layouts.app')
@section('content')
<section class="pb-5">
	<div class="productheaderbg py-6 pb-8">
    <div class="container d-lg-center">
        <div class="row ">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="h3 mb-2  fw-600">
                   @yield('header_m')
                </h1>
              
            </div>
            <div class="col-lg-6 fs-13">
                
            </div>
        </div>    
    </div>
</div>
    <div class="container">
		
		<div class="row">
       		 <div class="col-md-4" style="margin-top: -60px;">
			@include('frontend.inc.user_side_nav')
			</div>
			<div class="col-md-8">
				@yield('panel_content')
            </div>
			
		</div> 
		
    </div>
</section>
@endsection