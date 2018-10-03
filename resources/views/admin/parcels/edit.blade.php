@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.parcel.title')</h3>
    
    {!! Form::model($parcel, ['method' => 'PUT', 'route' => ['admin.parcels.update', $parcel->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('state', trans('quickadmin.parcel.fields.state').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('state'))
                        <p class="help-block">
                            {{ $errors->first('state') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('state', 'Processing', false, ['required' => '']) !!}
                            Processing
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('state', 'Sent', false, ['required' => '']) !!}
                            Sent
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('state', 'Received', false, ['required' => '']) !!}
                            Received
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('height', trans('quickadmin.parcel.fields.height').'', ['class' => 'control-label']) !!}
                    {!! Form::text('height', old('height'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('height'))
                        <p class="help-block">
                            {{ $errors->first('height') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('width', trans('quickadmin.parcel.fields.width').'', ['class' => 'control-label']) !!}
                    {!! Form::text('width', old('width'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('width'))
                        <p class="help-block">
                            {{ $errors->first('width') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('length', trans('quickadmin.parcel.fields.length').'', ['class' => 'control-label']) !!}
                    {!! Form::text('length', old('length'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('length'))
                        <p class="help-block">
                            {{ $errors->first('length') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('weight', trans('quickadmin.parcel.fields.weight').'', ['class' => 'control-label']) !!}
                    {!! Form::text('weight', old('weight'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('weight'))
                        <p class="help-block">
                            {{ $errors->first('weight') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('delivery_type', trans('quickadmin.parcel.fields.delivery-type').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('delivery_type'))
                        <p class="help-block">
                            {{ $errors->first('delivery_type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('delivery_type', '0', false, ['required' => '']) !!}
                            Air
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('delivery_type', '1', false, ['required' => '']) !!}
                            Ground
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('delivery_type', '2', false, ['required' => '']) !!}
                            Ships
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('delivery_type', '3', false, ['required' => '']) !!}
                            Mixed
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cost', trans('quickadmin.parcel.fields.cost').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cost', old('cost'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cost'))
                        <p class="help-block">
                            {{ $errors->first('cost') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('location_address', trans('quickadmin.parcel.fields.location').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('location_address', old('location_address'), ['class' => 'form-control map-input', 'id' => 'location-input', 'required' => '']) !!}
                    {!! Form::hidden('location_latitude', $parcel->location_latitude , ['id' => 'location-latitude']) !!}
                    {!! Form::hidden('location_longitude', $parcel->location_longitude , ['id' => 'location-longitude']) !!}
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
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('origin_address', trans('quickadmin.parcel.fields.origin').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('origin_address', old('origin_address'), ['class' => 'form-control map-input', 'id' => 'origin-input', 'required' => '']) !!}
                    {!! Form::hidden('origin_latitude', $parcel->origin_latitude , ['id' => 'origin-latitude']) !!}
                    {!! Form::hidden('origin_longitude', $parcel->origin_longitude , ['id' => 'origin-longitude']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('origin'))
                        <p class="help-block">
                            {{ $errors->first('origin') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div id="origin-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="origin-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('destination_address', trans('quickadmin.parcel.fields.destination').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('destination_address', old('destination_address'), ['class' => 'form-control map-input', 'id' => 'destination-input', 'required' => '']) !!}
                    {!! Form::hidden('destination_latitude', $parcel->destination_latitude , ['id' => 'destination-latitude']) !!}
                    {!! Form::hidden('destination_longitude', $parcel->destination_longitude , ['id' => 'destination-longitude']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('destination'))
                        <p class="help-block">
                            {{ $errors->first('destination') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div id="destination-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="destination-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('insurance', trans('quickadmin.parcel.fields.insurance').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('insurance', 0) !!}
                    {!! Form::checkbox('insurance', 1, old('insurance', old('insurance')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('insurance'))
                        <p class="help-block">
                            {{ $errors->first('insurance') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('priority', trans('quickadmin.parcel.fields.priority').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('priority', old('priority'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('priority'))
                        <p class="help-block">
                            {{ $errors->first('priority') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('delivery_time', trans('quickadmin.parcel.fields.delivery-time').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('delivery_time', old('delivery_time'), ['class' => 'form-control datetime', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('delivery_time'))
                        <p class="help-block">
                            {{ $errors->first('delivery_time') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
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