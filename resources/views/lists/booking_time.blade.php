@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left">
              {{ trans('lists.booking_time') }}
            </h1>
        </div>
    </div>

    <div class="row">
        <canvas id="rateChart" width="400" height="100" class="graph-canvas"></canvas>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Dagar i förväg</th>
                        <th>Antal</th>
                        <th>%</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $days => $count)
                    <tr>
                        <td>{{ $days }}</td>
                        <td>{{ $count }}</td>
                        <td>{{ $count * 100/ $total}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
    <script>
        var graphData = {
            labels: {!! json_encode($data->keys()) !!},
            datasets: [
                {
                    label: "Chart",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: {!! json_encode($data->values()) !!}
                }
        ]
        };

        var rateChartctx = document.getElementById("rateChart");
        var rateChart = new Chart(rateChartctx, {
            type: 'line',
            data: graphData,
            options: {
                legend: {
                    display: false
                }
            }
        });
    </script>
@endpush