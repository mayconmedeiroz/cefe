@extends('layouts.dashboard', ['title' => 'Inscrever-se em uma modalidade'])

@section('content')
    <div class="row">
        @foreach($sportClasses as $sportClass)
            <div class="col-lg-4 col-md-6">
            <div class="course-1-item">
                <figure class="thumnail">
                    <!--<img src="img/global/course_1.jpg" alt="Image" class="img-fluid">-->
                    <div class="category text-center"><h3>{{ $sportClass->sport_name }}</h3></div>
                </figure>
                <div class="course-1-content pb-4">
                    <h2>Turma {{ $sportClass->name }}</h2>
                    <p class="desc mb-4">{{ $sportClass->sport_time }}</p>
                    <p><a href="/student/enroll/{{ $sportClass->id }}" class="btn btn-primary btn-red rounded-0 px-4">Inscrever-se na turma</a></p>
                </div>
            </div>
            </div>
        @endforeach
    </div>
@endsection