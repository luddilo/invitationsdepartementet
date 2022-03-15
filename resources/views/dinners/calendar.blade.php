@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <h1 class="pull-left">{!! trans('general.dinners') !!}
                    <a class="btn btn-primary" href="{!! isset($user) ? route('app.users.dinners.create', $user->id) : route('app.dinners.create') !!}">{!! trans('general.add_new') !!}</a>
                </h1>
            </div>
        </div>
        <div clasS="row">
            <div class="col-md-12">
                <div id='calendar'></div>
            </div>
            <div class="calender-legends">
                <span class="calender-legend legend-green">Matchad</span>
                <span class="calender-legend legend-blue">Matchad utan bekräftelsemail</span>
                <span class="calender-legend legend-yellow">Saknar match</span>
                <span class="calender-legend legend-pink">Saknar match, ny svensk</span>
                <span class="calender-legend legend-red">Inställd</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/libs/js.cookie/js.cookie.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            // page is now ready, initialize the calendar...
            function openModal(url) {
                window.open(url);
            }

            // Reads a cookie, will return us to the same page in the calendar as last visited since this date is used as defaultDate for the cal
            var dateFromCookie = moment(Cookies.get('calViewDate')); // Safari needs us to send the string into moment for it to work

            $('#calendar').fullCalendar({
                header:  {
                    left:   'title',
                    center: 'basicWeek,month',
                    right:  'today prev,next'},
                defaultView: 'basicWeek',
                defaultDate: dateFromCookie,
                lang: 'sv',
                weekNumbers: 'true',
                height: 600,
                displayEventTime: true,
                events : '{!! $eventsRoute !!}',
                viewRender: function(view, element){
                    var currentdate = view.intervalStart;
                    Cookies.set('calViewDate', currentdate);
                },
                eventClick: function(calEvent, jsEvent, view) {
                    if (calEvent.url) {
                        //openModal(calEvent.url);
                        //return false;
                    }
                    //alert('Event: ' + calEvent.title);
                    //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                    //alert('View: ' + view.name);

                    // change the border color just for fun
                    $(this).css('border-color', 'red');

                },
                dayClick: function(date, jsEvent, view) {

     /*               alert('Clicked on: ' + date.format());

                    alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                    alert('Current view: ' + view.name);*/

                    // change the day's background color just for fun
                }
            });

        });
    </script>
@endpush