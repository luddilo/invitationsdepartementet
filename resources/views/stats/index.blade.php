@extends('layouts.app')

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left">
              Varierande statistik
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-sm-6">
            <h2 class="text-center">Kön</h2>
            <canvas id="genderChart" width="400" height="200" class="graph-canvas"></canvas>
        </div>
        <div class="col-sm-12 col-sm-6">
            <h2 class="text-center">Ålder</h2>
            <canvas id="ageChart" width="400" height="200" class="graph-canvas"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-6">
            <h2 class="text-center">Nationaliteter</h2>
            <canvas id="nationalChart" width="400" height="200" class="graph-canvas"></canvas>
        </div>
        <div class="col-sm-12 col-sm-6">
            <h2 class="text-center">Veckodagar</h2>
            <canvas id="daysChart" width="400" height="200" class="graph-canvas"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-sm-6">
            <h2 class="text-center">Barn</h2>
            <canvas id="childrenChart" width="400" height="200" class="graph-canvas"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>

    <script>
    var rateChartctx = document.getElementById("genderChart");
    var rateChart = new Chart(rateChartctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($genders->keys()) !!},
            datasets: [
                {
                    data: {!! json_encode($genders->values()) !!},
                    backgroundColor:  {!! json_encode(chart_colors(3)) !!},
                    hoverBackgroundColor:  {!! json_encode(chart_colors(3)) !!}
                }
            ]
        }
    });

    var ageChartctx = document.getElementById("ageChart");
    var ageChart = new Chart(ageChartctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($ages)) !!},
            datasets: [
                {
                    data: {!! json_encode(array_values($ages)) !!},
                    backgroundColor: {!! json_encode(chart_colors(7)) !!},
                    hoverBackgroundColor: {!! json_encode(chart_colors(7)) !!}
                }
            ]
        }
    });

    var nationalChartctx = document.getElementById("nationalChart");
    var nationalChart = new Chart(nationalChartctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($nationalities->keys()) !!},
            datasets: [
                {
                    data: {!! json_encode($nationalities->values()) !!},
                    backgroundColor: {!! json_encode(chart_colors(7)) !!},
                    hoverBackgroundColor: {!! json_encode(chart_colors(7)) !!}
                }
            ]
        }
    });

    var dayChartctx = document.getElementById("daysChart");
    var dayChart = new Chart(dayChartctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($days->keys()) !!},
            datasets: [
                {
                    data: {!! json_encode($days->values()) !!},
                    backgroundColor: {!! json_encode(chart_colors(7)) !!},
                    hoverBackgroundColor: {!! json_encode(chart_colors(7)) !!}
                }
            ]
        }
    });

    var childrenChartctx = document.getElementById("childrenChart");
    var childrenChart = new Chart(childrenChartctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode(array_keys($children)) !!},
            datasets: [
                {
                    data: {!! json_encode(array_values($children)) !!},
                    backgroundColor: {!! json_encode(chart_colors(6)) !!},
                    hoverBackgroundColor: {!! json_encode(chart_colors(6)) !!}
                }
            ]
        }
    });
    </script>
@endpush