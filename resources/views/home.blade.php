@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Report</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong>Incomes and expenses</strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" style="height: 180px; width: 763px;" width="763" height="180"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
                <div class="box-footer">
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-12">
                            <div class="description-block border-right">
                                <h5 class="description-header">₽{{ abs($expenses->sum('value')) }}</h5>
                                <span class="description-text">TOTAL EXPENSES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-12">
                            <div class="description-block border-right">
                                <h5 class="description-header">₽{{ $incomes->sum('value') }}</h5>
                                <span class="description-text">TOTAL PROFIT</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-xs-12">
                            <div class="description-block">
                                <h5 class="description-header">{{ $parcels->count() }}</h5>
                                <span class="description-text">TOTAL PARCELS COUNT</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Processing parcels</span>
                    <span class="info-box-number">{{ $parcels->where('state', 'Processing')->count() }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $parcels->where('state', 'Processing')->count() / $parcels->count() * 100 }}%"></div>
                    </div>
                    <span class="progress-description">
                    {{ $parcels->where('state', 'Processing')->count() / $parcels->count() * 100 }}%
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Sent parcels</span>
                    <span class="info-box-number">{{ $parcels->where('state', 'Sent')->count() }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $parcels->where('state', 'Sent')->count() / $parcels->count() * 100 }}%"></div>
                    </div>
                    <span class="progress-description">
                    {{ $parcels->where('state', 'Sent')->count() / $parcels->count() * 100 }}%
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Received parcels</span>
                    <span class="info-box-number">{{ $parcels->where('state', 'Received')->count() }}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: {{ $parcels->where('state', 'Received')->count() / $parcels->count() * 100 }}%"></div>
                    </div>
                    <span class="progress-description">
                    {{ $parcels->where('state', 'Received')->count() / $parcels->count() * 100 }}%
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->

            <!-- /.info-box -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        // -----------------------
        // - MONTHLY SALES CHART -
        // -----------------------

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
        // This will get the first returned node in the jQuery collection.
        var salesChart       = new Chart(salesChartCanvas);

        var salesChartData = {
            labels  : {!! json_encode($totalMoney->pluck('date')->map(function ($item, $key) {
    return \Carbon\Carbon::parse($item)->toDateString();
})); !!},
            datasets: [
                {
                    label               : 'Total money',
                    fillColor           : 'rgba(60,141,188,0.9)',
                    strokeColor         : 'rgba(60,141,188,0.8)',
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : {!! json_encode($totalMoney->pluck('value_sum')) !!}
                }
            ]
        };

        var salesChartOptions = {
            // Boolean - If we should show the scale at all
            showScale               : true,
            // Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : false,
            // String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            // Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            // Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            // Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            // Boolean - Whether the line is curved between points
            bezierCurve             : true,
            // Number - Tension of the bezier curve between points
            bezierCurveTension      : 0.3,
            // Boolean - Whether to show a dot for each point
            pointDot                : false,
            // Number - Radius of each point dot in pixels
            pointDotRadius          : 4,
            // Number - Pixel width of point dot stroke
            pointDotStrokeWidth     : 1,
            // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius : 20,
            // Boolean - Whether to show a stroke for datasets
            datasetStroke           : true,
            // Number - Pixel width of dataset stroke
            datasetStrokeWidth      : 2,
            // Boolean - Whether to fill the dataset with a color
            datasetFill             : true,
            // String - A legend template
            legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);

  // ---------------------------
  // - END MONTHLY SALES CHART -
  // ---------------------------
    </script>
@endsection