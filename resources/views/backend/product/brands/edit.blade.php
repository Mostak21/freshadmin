@extends('backend.layouts.app')

@section('content')

<div class="rit-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Brand Information')}}</h5>
</div>

<div class="col-lg-8 mx-auto">
    <div class="card">
        <div class="card-body p-0">
            <ul class="nav nav-tabs nav-fill border-light">
  				@foreach (\App\Models\Language::all() as $key => $language)
  					<li class="nav-item">
  						<a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('brands.edit', ['id'=>$brand->id, 'lang'=> $language->code] ) }}">
  							<img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
  							<span>{{ $language->name }}</span>
  						</a>
  					</li>
	            @endforeach
  			</ul>
            <form class="p-4" action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                <input type="hidden" name="lang" value="{{ $lang }}">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" value="{{ $brand->getTranslation('name', $lang) }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Logo')}} <small>({{ translate('120x80') }})</small></label>
                    <div class="col-md-9">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="logo" value="{{$brand->logo}}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 row">

                    <label class="col-sm-3 col-from-label" for="name">{{translate('Category')}}<i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                    <div class="col-sm-9">
                      
                    <div>
                        <input type="checkbox" name="category[]" value="fashion" @if(array_search('fashion',explode(",",$brand->cat))!==false)
                            checked
                        @endif > Fashion
                    </div>
                    <div>
                        <input type="checkbox" name="category[]" value="fragnance" @if(array_search('fragnance',explode(",",$brand->cat))!==false)
                        checked
                    @endif> Fragnance
                    </div>
						<div>
                        <input type="checkbox" name="category[]" value="Beauty_&_Skincare" @if(array_search('Beauty_&_Skincare',explode(",",$brand->cat))!==false)
                        checked
                    @endif> Beauty & Skincare
                    </div>
                    <div>
                        <input type="checkbox" name="category[]" value="electronics" @if(array_search('electronics',explode(",",$brand->cat))!==false)
                        checked
                    @endif> Electronics
                    </div>
                    <div>
                        <input type="checkbox" name="category[]" value="others" @if(array_search('others',explode(",",$brand->cat))!==false)
                        checked
                    @endif> Others
                    </div>
                    </div>
	
                </div>
				             <div class="row form-group mb-3">
                    <label class="col-sm-3" for="name">{{translate('Category')}}</label><br>
                    <div class="col-sm-9">
                    <span class="pr-2">
                        <input type="radio" name="published" value="1" @if($brand->published=="1")
                        checked
                        @endif> Show
                    </span>
                    <span>
                        <input type="radio" name="published" value="0"  @if($brand->published!="1")
                        checked
                    @endif > Hide
                    </span>
                        </div>
                    
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">{{translate('Meta Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="meta_title" value="{{ $brand->meta_title }}" placeholder="{{translate('Meta Title')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">{{translate('Meta Description')}}</label>
                    <div class="col-sm-9">
                        <textarea name="meta_description" rows="8" class="form-control">{{ $brand->meta_description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label" for="name">{{translate('Slug')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{translate('Slug')}}" id="slug" name="slug" value="{{ $brand->slug }}" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
