@extends('frontend.layouts.app')
@section('content')
<section class="pb-5">
	
    <div class="container-custom">
		
		<div class="row">
       		 <div class="col-12">
			    @include('frontend.inc.user_side_nav')
			</div>
			<div class="col-12">
				@yield('panel_content')
            </div>
			
		</div> 
		
    </div>
</section>
@endsection