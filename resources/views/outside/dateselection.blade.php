@extends('layouts.outside')

<link rel='stylesheet' href='/libs/fullcalendar/fullcalendar.css' />

@section('content')
    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">

        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <h1 class="pull-left">{!! trans('general.select_dates_for_your_dinner') !!}</h1>
            </div>
            <div class="col-md-12">
                @if(count($messages) > 0)
                    @include('common.message', $messages)
                @endif
            </div>
        </div>
        <div clasS="row">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'post_dateselection']) !!}
                {!! Form::hidden('date', null, ['id' => 'date-input']) !!}
                {!! Form::hidden('another', $another) !!}
                {!! Form::hidden('uuid', $uuid) !!}
                {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary pull-right', 'style' => 'margin-top: 25px; margin-left: 5px']) !!}
                @if ($another != true)
                    <a class="btn btn-alert pull-right" style="text-decoration: underline; margin-top: 25px;" href="{!! route('dateselection.select_later', $uuid) !!}">Välj senare (vi skickar ett mail)</a>
                @endif
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src='/libs/fullcalendar/fullcalendar.js'></script>
    <script src='/libs/fullcalendar/lang/sv.js'></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var maxAllowedEvents = 1; //not used at the moment since we delete old event if new one is created
            var constraints = [];

            @foreach($dateConstraints as $index => $constraint)
                constraints.push({
                    start: moment('{!! $constraint['from'] !!}', 'YYYY-MM-DD'), //needed for selectConstraint
                    end: moment('{!! $constraint['to'] !!}', 'YYYY-MM-DD').add(1, 'days') //needed for selectConstraint
                });
            @endforeach
            $('#calendar').fullCalendar({
                header:  {
                    left:   'title',
                    right:  'prev,next'},
                defaultView: 'month',
                lang: 'sv',
                firstDay: 1,
                defaultDate: '{!! $startDate !!}',
                weekNumbers: 'true',
                weekNumberTitle: 'v',
                weekNumberCalculation: 'ISO',
                height: 600,
                selectable: true,
                selectOverlap: false,
                unselectAuto: true,
                eventOverlap: false,
                selectConstraint: constraints,
                dayRender: function(date, cell){
                    for (var i = 0; i < constraints.length; i++){
                        if (date > constraints[i].start && date < constraints[i].end){
                            $(cell).css('background-color', '#EEE');
                            break;
                        }
                        else {
                           $(cell).css('background-color', 'white');
                        }
                    }
                },
                eventRender: function(event, element) {
                    $('#calendar').fullCalendar('removeEvents');
                    element.append( "<span class='fa fa-remove closeOnClick'></span>" );
                    element.find(".closeOnClick").click(function() {
                        $('#calendar').fullCalendar('removeEvents',event._id);
                    });
                    $('#date-input').val(event.start.format('YYYY-MM-DD'));
                },
                select: function(start, end, allDay) {

                    if ($('#calendar').fullCalendar('clientEvents').length < maxAllowedEvents) { //conditional never not true since we delete events on new creation of event
                        $('#calendar').fullCalendar('renderEvent',
                                {
                                    title: 'Valt datum',
                                    start: start,
                                    end: start,
                                    allDay: true
                                },
                                true // make the event "stick"
                        );
                    }
                    else {
                        alert('Du kan maximalt välja ' + maxAllowedEvents + ' datum');
                    }
                }
            });

            @if (isset($selectedDate) && date('Y-m-d', strtotime($selectedDate)) == $selectedDate)
                $('#calendar').fullCalendar('renderEvent',
                    {
                        title: 'Valt datum',
                        start: '{{ $selectedDate }}',
                        end: '{{ $selectedDate }}',
                        allDay: true
                    }, true // make the event "stick"
                );
            @endif
        });
    </script>
@endpush