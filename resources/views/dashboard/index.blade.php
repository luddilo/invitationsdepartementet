@extends('layouts.app')

@section('content')

    <h1>Antal middagar</h1>
    <canvas id="totalChart" width="400" height="100" class="graph-canvas"></canvas>

    <h1>Middagar per månad</h1>
    <canvas id="rateChart" width="400" height="100" class="graph-canvas"></canvas>

    <form action="{{ url()->current() }}" method="get" class="text-center">
        {!! Form::select('from', $months, $from) !!} till {!! Form::select('to', $months, $to) !!}
        {!! Form::submit('Ok') !!}
    </form>

    <div class="row">
        <div class="col-md-12">

            @foreach($data as $region_name => $region)
                @if ($region_name != 'months')
                    <h2>{{ $region_name }}</h2>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <th>Månad</th>
                        @foreach($data['months'] as $month)
                            <th>{{ $month }}</th>
                        @endforeach
                        </thead>
                        <tbody>
                            <tr>
                                <td>Matchade middagar</td>
                                @foreach($data['months'] as $month)
                                    <td>{{ $region['dinnersWithMatches'][$month] or '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Ej matchade middagar</td>
                                @foreach($data['months'] as $month)
                                    <td>{{ $region['dinnersWithoutMatches'][$month] or '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Nya etablerade svenskar</td>
                                @foreach($data['months'] as $month)
                                    <td>{{ $region['fluentMembers'][$month] or '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Nya svenskar</td>
                                @foreach($data['months'] as $month)
                                    <td>{{ $region['nonFluentMembers'][$month] or '-' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>Ambassadörer</td>
                                @foreach($data['months'] as $month)
                                    <td>{{ $region['ambassadors'][$month] or '-' }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                @endif
            @endforeach
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
    <script>
        var labels = [@foreach ($data['months'] as $month) "{{ $month }}", @endforeach];

        var graphData = {
            labels: labels,
            datasets: [
                @foreach($data as $region_name => $region)
                @if ($region_name != 'months' && $region_name != 'Ingen region passar mig')
                {
                    label: "{{ $region_name }}",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [
                        @foreach($data['months'] as $month)
                        {{ $region['dinnersWithMatches'][$month] or '0' }},
                        @endforeach
                        ]
                },
                @endif
            @endforeach
        ]
        };

        var totalCount = [];
        var datasets = graphData.datasets;

        for (var i = 0; i < datasets.length; i++) {
            var lineData = datasets[i];
            for (n = 0; n < lineData.data.length; n++) {
                if (totalCount.length <= n) {
                    totalCount.push(lineData.data[n]);
                } else {
                    totalCount[n] += lineData.data[n];
                }
            }
        }

        var totalSet = {
            label: "Totalt",
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: totalCount,
        };

        graphData.datasets.push(totalSet);

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

        var totalCumulative = totalCount;
        for (var i = 1; i < totalCount.length; i++) {
            totalCumulative[i] += totalCumulative[i-1];
        }

        var graphDataTotal = {
            labels: labels,
            datasets: [
                {
                    label: "Middagar",
                    fill: true,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: totalCumulative
                },
            ]
        };

        var totalChartctx = document.getElementById("totalChart");
        var totalChart = new Chart(totalChartctx, {
            type: 'line',
            data: graphDataTotal,
            options: {
                legend: {
                    display: false
                }
            }
        });
    </script>
@endpush