@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.truck.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.trucks.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('state', trans('quickadmin.truck.fields.state').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('state'))
                        <p class="help-block">
                            {{ $errors->first('state') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('state', 'Online', false, ['required' => '']) !!}
                            Online
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('state', 'Offline', false, ['required' => '']) !!}
                            Offline
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('state', 'Disabled', false, ['required' => '']) !!}
                            Disabled
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('car_model', trans('quickadmin.truck.fields.car_model').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('car_model', old('height'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('car_model'))
                        <p class="help-block">
                            {{ $errors->first('car_model') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('driver_name', trans('quickadmin.truck.fields.driver_name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('driver_name', old('width'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('driver_name'))
                        <p class="help-block">
                            {{ $errors->first('driver_name') }}
                        </p>
                    @endif
                </div>
            </div>

            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('location', trans('quickadmin.truck.fields.location').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('location', old('truck_location'), ['class' => 'form-control map-input', 'id' => 'location-input', 'required' => '']) !!}
                    {!! Form::hidden('latitude', 0 , ['id' => 'location-latitude']) !!}
                    {!! Form::hidden('longitude', 0 , ['id' => 'location-longitude']) !!}
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