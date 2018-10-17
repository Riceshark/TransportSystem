@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.truck.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.truck.fields.state')</th>
                            <td field-key='state'>{{ $truck->state }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.truck.fields.car_model')</th>
                            <td field-key='height'>{{ $truck->car_model }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.truck.fields.driver_name')</th>
                            <td field-key='width'>{{ $truck->driver_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.truck.fields.latitude')</th>
                            <td field-key='length'>{{ $truck->latitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.truck.fields.longitude')</th>
                            <td field-key='weight'>{{ $truck->longitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.truck.fields.location')</th>
                            <td field-key='weight'>
                                <div id='location-map' style='width: 600px;height: 300px;' class='map' data-key='location' data-latitude='{{$truck->latitude}}' data-longitude='{{$truck->longitude}}'></div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.trucks.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
                const field = maps[i];
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
