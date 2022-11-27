@extends('backend.layouts.app')

@section('content')

<div class="rit-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('City Information')}}</h5>
</div>

<div class="row">
  <div class="col-lg-8 mx-auto">
      <div class="card">
          <div class="card-body p-0">
              <ul class="nav nav-tabs nav-fill border-light">
    				@foreach (\App\Models\Language::all() as $key => $language)
    					<li class="nav-item">
    						<a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('cities.edit', ['id'=>$city->id, 'lang'=> $language->code] ) }}">
    							<img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
    							<span>{{ $language->name }}</span>
    						</a>
    					</li>
  	            @endforeach
    			</ul>
              <form class="p-4" action="{{ route('cities.update', $city->id) }}" method="POST" enctype="multipart/form-data">
                  <input name="_method" type="hidden" value="PATCH">
                  <input type="hidden" name="lang" value="{{ $lang }}">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="name">{{translate('Name')}}</label>
                      <input type="text" placeholder="{{translate('Name')}}" value="{{ $city->getTranslation('name', $lang) }}" name="name" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label for="state_id">{{translate('State')}}</label>
                      <select class="select2 form-control rit-selectpicker" name="state_id" data-selected="{{ $city->state_id }}" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                          @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group mb-3">
                      <label for="name">{{translate('Cost')}}</label>
                      <input type="number" min="0" step="0.01" placeholder="{{translate('Cost')}}" name="cost" class="form-control" value="{{ $city->cost }}" required>
                  </div>

                  <div class="form-group mb-3 text-right">
                      <button type="submit" class="btn btn-primary">{{translate('Update')}}</button>
                  </div>
              </form>

              @foreach($agents as $key=> $agent )
                @php
                $cost =null;
                    if( !empty($agent_costs)){
                        foreach($agent_costs as $key=> $costs){
                            if ($costs->delivery_agent_id == $agent->id){
                                $cost=$costs;
                                if ($cost->status == 1){
                                    $cost_status="checked";
                                }
                                if ($cost->status == 0){
                                    $cost_status="";
                                }
                            }
                        }
                    }
                @endphp

              <form class="p-4" action="{{ route('deliverycost.save', $cost->id??0) }}" method="GET" enctype="multipart/form-data">
{{--                  <input name="_method" type="hidden" value="PATCH">--}}
                  <input type="hidden" name="delivery_agent_id" value="{{$agent->id??''}}">
                  <input type="hidden" name="city_id" value="{{$city->id}}">
                  @csrf
                  <div class="row">
                      <div class="col-2 col-sm-1 text-left">
                          <label class="rit-switch rit-switch-success ">
                              <input onchange="update_status(this)" data-city="{{$city->id}}" value="{{ $cost->id??'' }}" name="{{$agent->id??''}}" type="checkbox" {{$cost_status??''}} {{ $cost->id??'checked' }}>
                              <span class="slider round"></span>
                          </label>
                      </div>
                      <div class="col-10 col-sm-11 text-left">
                          <h5 class="mb-2 ml-2 ml-sm-0 h6">{{$agent->name}}</h5>
                      </div>

                  </div>
                  <div class="row">
                      <div class="col-4 col-sm-5"> <div class="form-group mb-3">
                              <input type="number" min="0" step="0.01" placeholder="{{translate('Cost')}}" value="{{$cost->cost??''}}" name="cost" class="form-control" required>
                          </div>
                      </div>
                      <div class="col-5 col-sm-5">
                          <div class="form-group mb-3">
                              <input type="text" placeholder="{{translate('Duration')}}" value="{{$cost->time??''}}" name="time" class="form-control" required>
                          </div>
                      </div>
                      <div class="col-3 col-sm-2">
                          <div class="form-group mb-3 text-center">
                              <button type="submit" class="btn btn-sm btn-outline-primary">{{translate('Save')}}</button>
                          </div>
                      </div>
                  </div>
              </form>
              @endforeach
              <p class="m-2 fw-100 fs-12"> *Put only one space in duration input for delete the instance</p>
          </div>
      </div>
  </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">


        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('deliverycost.status') }}', {_token:'{{ csrf_token() }}', id:el.value, agent:el.name, city:el.dataset.city, status:status}, function(data){
                if(data == 1){
                    RIT.plugins.notify('success', '{{ translate('Shipping Agent status updated successfully') }}');
                    el.value = data[1];
                    console.log(data);
                }
                else{
                    RIT.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                    console.log(data);
                }
            });
        }

    </script>
@endsection
