@extends('backend.layouts.app')

@section('content')

<div class="rit-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">Sitemap Genaretor</h1>
        </div> 
    </div>
</div>

<div class="card">
    
    <div class="card-body">
        <div class="align-item-center text-center">
            <a href="{{route('sitemapbh')}}" class="text-reset px-2">  <button class="btn btn-primary btn-md">
                   Generate Sitemap
                </button> </a>

                <a href="{{route('sitemapv')}}" class="text-reset px-2">  <button class="btn btn-success btn-md">
                    View Sitemap
                 </button> </a>
        </div>
        
    </div>
</div>

@endsection




