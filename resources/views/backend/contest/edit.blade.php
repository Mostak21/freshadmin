@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{translate('Contest Information')}}</h5>
                </div>
                <div class="card-body">
                    <form id="add_form" class="form-horizontal" action="{{ route('contest.update') }}" method="POST">
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
                                        <option value="{{ $team->id }}" @if($team->id == $contest->team1) selected @endif>
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
                                        <option value="{{ $team->id }}" @if($team->id == $contest->team2) selected @endif>
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
                                    <option value="111"@if($contest->winner == 111) selected @endif>DRAW</option>
                                    @foreach ($teams as $team)
{{--                                        <img src="{{$team->image}}" height="50px">--}}
                                        <option value="{{ $team->id }}"@if($team->id == $contest->winner) selected @endif>
                                            {{$team->image}}
                                            {{ $team->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @php
                            $start_date =$contest->time_start /*date('d-m-Y H:i:s', $contest->time_start)*/;
                            $end_date =$contest->time_end /*date('d-m-Y H:i:s', $contest->time_end)*/;
                        @endphp
                        <div class="form-group row">
                            <label class="col-sm-3 control-label" for="date_range">
                                Contest Time Range
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control aiz-date-range" name="date_range"
                                       placeholder="{{translate('Select Date')}}"
                                       @if($contest->time_start && $contest->time_end) value="{{ $start_date.' to '.$end_date }}" @endif
                                       data-time-picker="true"
                                       data-format="DD-MM-Y HH:mm:ss"
                                       data-separator=" to "
                                       autocomplete="off"
                                       required>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{$contest->id}}">

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
{{--    <script>--}}
{{--        function makeSlug(val) {--}}
{{--            let str = val;--}}
{{--            let output = str.replace(/\s+/g, '-').toLowerCase();--}}
{{--            $('#slug').val(output);--}}
{{--        }--}}
{{--    </script>--}}
@endsection
