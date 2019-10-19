@extends('layouts.dashboard', ['title' => 'Dashboard'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('vendors/fullcalendar/css/fullcalendar.min.css') }}"/>
@endsection

@section('content')

<div class="calendar-div p-4">
    <div class="calendar p-4" id='calendar'></div>
</div>
@endsection
@section('custom-js')
    <script src="{{ asset('vendors/fullcalendar/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/js/fullcalendar.pt-br.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            var calendar = new FullCalendar.Calendar($('#calendar').get(0), {
                plugins: ['dayGrid'],
                events: [
                @foreach($sportClasses as $sportClass)
                    {
                        title : '{{ $sportClass->name}}',
                        daysOfWeek : '{{ $sportClass->weekday}}',
                        startTime : '{{ $sportClass->start_time }}',
                        endTime: '{{ $sportClass->end_time }}',
                    },
                @endforeach
                ],
                header: {
                    right: 'today prev,next'
                },
                height: 300,
                navLinks: false,
                defaultView: 'dayGridWeek',
                eventLimit: true,
                minTime: '07:00:00',
                maxTime: '18:00:01',
                locale: 'pt-br',
                displayEventEnd: true,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                },
            });
            calendar.render();
            $('.fc-left').html('<h5>Calendário CEFE</h5>');
        });
    </script>
@endsection
