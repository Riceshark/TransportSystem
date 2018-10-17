@extends('layouts.app')

@section('content')
    <h3 class="page-title">Budget</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Name</th>
                            <td field-key='name'>{{ $budget->name }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td field-key='value'>{{ $budget->value }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td field-key='date'>{{ $budget->date }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td field-key='description'>{{ $budget->description }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

<!-- Tab panes -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.budgets.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop