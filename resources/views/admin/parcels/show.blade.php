@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.parcel.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.state')</th>
                            <td field-key='state'>{{ $parcel->state }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.height')</th>
                            <td field-key='height'>{{ $parcel->height }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.width')</th>
                            <td field-key='width'>{{ $parcel->width }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.length')</th>
                            <td field-key='length'>{{ $parcel->length }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.weight')</th>
                            <td field-key='weight'>{{ $parcel->weight }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.delivery-type')</th>
                            <td field-key='delivery_type'>{{ $parcel->delivery_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.cost')</th>
                            <td field-key='cost'>{{ $parcel->cost }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.location')</th>
                            <td>
                    <strong>{{ $parcel->location_address }}</strong>
                    <div id='location-map' style='width: 600px;height: 300px;' class='map' data-key='location' data-latitude='{{$parcel->location_latitude}}' data-longitude='{{$parcel->location_longitude}}'></div>
                </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.origin')</th>
                            <td>
                    <strong>{{ $parcel->origin_address }}</strong>
                    <div id='origin-map' style='width: 600px;height: 300px;' class='map' data-key='origin' data-latitude='{{$parcel->origin_latitude}}' data-longitude='{{$parcel->origin_longitude}}'></div>
                </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.destination')</th>
                            <td>
                    <strong>{{ $parcel->destination_address }}</strong>
                    <div id='destination-map' style='width: 600px;height: 300px;' class='map' data-key='destination' data-latitude='{{$parcel->destination_latitude}}' data-longitude='{{$parcel->destination_longitude}}'></div>
                </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.insurance')</th>
                            <td field-key='insurance'>{{ Form::checkbox("insurance", 1, $parcel->insurance == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.priority')</th>
                            <td field-key='priority'>{{ $parcel->priority }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.parcel.fields.delivery-time')</th>
                            <td field-key='delivery_time'>{{ $parcel->delivery_time }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#parcels_history" aria-controls="parcels_history" role="tab" data-toggle="tab">Parcels history</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="parcels_history">
<table class="table table-bordered table-striped {{ count($parcels_histories) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.parcels-history.fields.enter-time')</th>
                        <th>@lang('quickadmin.parcels-history.fields.leave-time')</th>
                        <th>@lang('quickadmin.parcels-history.fields.parcel')</th>
                        <th>@lang('quickadmin.parcels-history.fields.location')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($parcels_histories) > 0)
            @foreach ($parcels_histories as $parcels_history)
                <tr data-entry-id="{{ $parcels_history->id }}">
                    <td field-key='enter_time'>{{ $parcels_history->enter_time }}</td>
                                <td field-key='leave_time'>{{ $parcels_history->leave_time }}</td>
                                <td field-key='parcel'>{{ $parcels_history->parcel->state ?? '' }}</td>
                                <td field-key='location'>{{ $parcels_history->location_address }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('parcels_history_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.parcels_histories.restore', $parcels_history->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('parcels_history_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.parcels_histories.perma_del', $parcels_history->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('parcels_history_view')
                                    <a href="{{ route('admin.parcels_histories.show',[$parcels_history->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('parcels_history_edit')
                                    <a href="{{ route('admin.parcels_histories.edit',[$parcels_history->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('parcels_history_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.parcels_histories.destroy', $parcels_history->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.parcels.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
 
    <script>
        function initialize() {
            const maps = document.getElementsByClassName("map");
            for (let i = 0; i < maps.length; i++) {
                const field = maps[i]
                const fieldKey = field.dataset.key;
                const latitude = parseFloat(field.dataset.latitude) || -33.8688;
                const longitude = parseFloat(field.dataset.longitude) || 151.2195;
        
                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });
        
                marker.setVisible(true);
            }    
              
          }
    </script>
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
