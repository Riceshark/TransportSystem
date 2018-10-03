@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.parcels-history.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.parcels_histories.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('enter_time', trans('quickadmin.parcels-history.fields.enter-time').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('enter_time', old('enter_time'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('enter_time'))
                        <p class="help-block">
                            {{ $errors->first('enter_time') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('leave_time', trans('quickadmin.parcels-history.fields.leave-time').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('leave_time', old('leave_time'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('leave_time'))
                        <p class="help-block">
                            {{ $errors->first('leave_time') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('parcel_id', trans('quickadmin.parcels-history.fields.parcel').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('parcel_id', $parcels, old('parcel_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('parcel_id'))
                        <p class="help-block">
                            {{ $errors->first('parcel_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('location_address', trans('quickadmin.parcels-history.fields.location').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('location_address', old('location_address'), ['class' => 'form-control map-input', 'id' => 'location-input', 'required' => '']) !!}
                    {!! Form::hidden('location_latitude', 0 , ['id' => 'location-latitude']) !!}
                    {!! Form::hidden('location_longitude', 0 , ['id' => 'location-longitude']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('location'))
                        <p class="help-block">
                            {{ $errors->first('location') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div id="location-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="location-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif
            
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
   <script src="/adminlte/js/mapInput.js"></script>

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop