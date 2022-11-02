@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Contest Information')}}</h5>
            </div>
            <div class="card-body">
                <form id="add_form" class="form-horizontal" action="{{ route('contest.store') }}" method="POST">
                    @csrf

                    <div class="form-group row" id="team1">
                        <label class="col-md-3 col-from-label">
                            Team 1
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker" name="team1" id="team1_id" data-live-search="true" required>
                                <option>--</option>
                                @foreach ($teams as $team)
                                    <img src="{{$team->image}}" height="50px">
                                <option value="{{ $team->id }}">
                                    {{$team->image}}
                                    {{ $team->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" id="team2">
                        <label class="col-md-3 col-from-label">
                            Team 2
                            <span class="text-danger">*</span>
                        </label>
                        {{--                        {{dd($teams[0])}}--}}
                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker" name="team2" id="team2_id" data-live-search="true" required>
                                <option>--</option>
                                @foreach ($teams as $team)
                                    <img src="{{$team->image}}" height="50px">
                                    <option value="{{ $team->id }}">
                                        {{$team->image}}
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" id="winner">
                        <label class="col-md-3 col-from-label">
                            Winner team
{{--                            <span class="text-danger">*</span>--}}
                        </label>
                        {{--                        {{dd($teams[0])}}--}}
                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker" name="winner" id="winner_id" data-live-search="true">
                                <option>--</option>
                                @foreach ($teams as $team)
                                    <img src="{{$team->image}}" height="50px">
                                    <option value="{{ $team->id }}">
                                        {{$team->image}}
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="date_range">
                            Contest Time Range
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="{{translate('Select Date')}}" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off" required>
                        </div>
                    </div>
                    
                    
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">{{translate('Slug')}}--}}
{{--                            <span class="text-danger">*</span></label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <input type="text" placeholder="{{translate('Slug')}}" name="slug" id="slug" class="form-control" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label" for="signinSrEmail">--}}
{{--                            {{translate('Banner')}} --}}
{{--                            <small>(1300x650)</small>--}}
{{--                        </label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <div class="input-group" data-toggle="aizuploader" data-type="image">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                                    <div class="input-group-text bg-soft-secondary font-weight-medium">--}}
{{--                                        {{ translate('Browse')}}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>--}}
{{--                                <input type="hidden" name="banner" class="selected-files">--}}
{{--                            </div>--}}
{{--                            <div class="file-preview box sm">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">--}}
{{--                            {{translate('Short Description')}}--}}
{{--                            <span class="text-danger">*</span>--}}
{{--                        </label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <textarea name="short_description" rows="5" class="form-control" required=""></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-from-label">--}}
{{--                            {{translate('Description')}}--}}
{{--                        </label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <textarea class="aiz-text-editor" name="description"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">{{translate('Meta Title')}}</label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <input type="text" class="form-control" name="meta_title" placeholder="{{translate('Meta Title')}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label" for="signinSrEmail">--}}
{{--                            {{translate('Meta Image')}} --}}
{{--                            <small>(200x200)+</small>--}}
{{--                        </label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <div class="input-group" data-toggle="aizuploader" data-type="image">--}}
{{--                                <div class="input-group-prepend">--}}
{{--                                    <div class="input-group-text bg-soft-secondary font-weight-medium">--}}
{{--                                        {{ translate('Browse')}}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>--}}
{{--                                <input type="hidden" name="meta_img" class="selected-files">--}}
{{--                            </div>--}}
{{--                            <div class="file-preview box sm">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">{{translate('Meta Description')}}</label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <textarea name="meta_description" rows="5" class="form-control"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group row">--}}
{{--                        <label class="col-md-3 col-form-label">--}}
{{--                            {{translate('Meta Keywords')}}--}}
{{--                        </label>--}}
{{--                        <div class="col-md-9">--}}
{{--                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="{{translate('Meta Keywords')}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">
                            {{translate('Save')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
{{--<script>--}}
{{--    function makeSlug(val) {--}}
{{--        let str = val;--}}
{{--        let output = str.replace(/\s+/g, '-').toLowerCase();--}}
{{--        $('#slug').val(output);--}}
{{--    }--}}
{{--</script>--}}
@endsection
