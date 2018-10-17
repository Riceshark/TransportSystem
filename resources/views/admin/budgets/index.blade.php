@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Budget</h3>
    @can('budget_create')
        <p>
            <a href="{{ route('admin.budgets.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

        </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($budgets) > 0 ? 'datatable' : '' }} @can('budget_delete') dt-select @endcan">
                <thead>
                <tr>
                    @can('budget_delete')
                        <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>
                    @endcan

                    <th>Name</th>
                    <th>Value</th>
                    <th>Date</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @if (count($budgets) > 0)
                    @foreach ($budgets as $budget)
                        <tr data-entry-id="{{ $budget->id }}">
                            @can('budget_delete')
                                <td></td>
                            @endcan

                            <td field-key='name'>{{ $budget->name }}</td>
                            <td field-key='value'>{{ $budget->value }}</td>
                            <td field-key='date'>{{ $budget->date }}</td>
                            <td>
                                @can('budget_view')
                                    <a href="{{ route('admin.budgets.show',[$budget->id]) }}"
                                       class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                @endcan
                                @can('budget_edit')
                                    <a href="{{ route('admin.budgets.edit',[$budget->id]) }}"
                                       class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                @endcan
                                @can('budget_delete')
                                    {!! Form::open(array(
                                                                            'style' => 'display: inline-block;',
                                                                            'method' => 'DELETE',
                                                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                            'route' => ['admin.budgets.destroy', $budget->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="18">@lang('quickadmin.qa_no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('budget_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.budgets.mass_destroy') }}';
        @endcan

    </script>
@endsection