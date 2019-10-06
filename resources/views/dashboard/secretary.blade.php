@extends('layouts.dashboard', ['title' => 'Dashboard'])

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <div class="tile-stats tile-blue">
            <div class="tile-icon"><i class="fas fa-user"></i></div>
            <div class="tile-num">{{ $student }}</div>
            <h3>Alunos</h3>
            <p>Total de alunos</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile-stats tile-hoki">
            <div class="tile-icon"><i class="fas fa-user-friends"></i></div>
            <div class="tile-num">{{ $studentClass }}</div>
            <h3>Alunos em turma</h3>
            <p>Total de alunos em uma turma</p>
        </div>
    </div>
</div>
<div class="calendar-div p-4">
    <div class="calendar p-4" id='calendar'></div>
</div>
@endsection
@section('custom-js')
    <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.pt-br.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            var calendar = new FullCalendar.Calendar($('#calendar').get(0), {
                plugins: ['dayGrid'],
                events: [
                @foreach(\App\SportClass::get() as $sportClass)
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
                height: 600,
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
