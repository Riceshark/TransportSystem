@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.parcels-history.title')</h3>
    @can('parcels_history_create')
    <p>
        <a href="{{ route('admin.parcels_histories.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('parcels_history_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.parcels_histories.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.parcels_histories.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($parcels_histories) > 0 ? 'datatable' : '' }} @can('parcels_history_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('parcels_history_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('parcels_history_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
@stop

@section('javascript') 
    <script>
        @can('parcels_history_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.parcels_histories.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection