@extends('layouts.dashboard', ['title' => 'Inscrever-se em uma modalidade'])

@section('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.11/css/bootstrap-select.min.css"/>
    <style>
        .course-1-item {
            box-shadow: 0 2px 10px 0 rgba(0, 0, 0, .1);
            margin-bottom: 30px;
        }

        .course-1-item figure {
            position: relative
        }

        .course-1-item .category {
            background-color: #007bff;
            padding: 20px
        }

        .course-1-item .category h3 {
            color: #fff;
            font-size: 20px;
            margin-bottom: 0
        }

        .course-1-item .course-1-content {
            padding: 20px;
            text-align: center
        }

        .course-1-item .course-1-content h2 {
            margin: 0 0 30px 0;
            font-size: 18px;
            color: #000
        }

        .course-1-item .course-1-content .desc {
            font-size: 15px
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="form">
                <form method="get" action="{{ route('student.enroll.index') }}">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Modalidade</label>
                                    <select class="form-control selectpicker" id="sport" name="sport" title="Pesquisar por modalidade..." data-live-search="true" data-live-search-placeholder="Procurar...">
                                        @foreach($sports as $sport)
                                            <option value="{{ $sport->id }}" {{ (old('sport')) ? 'selected' : '' }}>{{ $sport->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Professor</label>
                                    <select class="form-control selectpicker" id="teacher" name="teacher" title="Pesquisar por professor..." data-live-search="true" data-live-search-placeholder="Procurar...">
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Dia da Semana</label>
                                    <select class="form-control selectpicker" id="weekday" name="weekday" title="Pesquisar por dia da semana..." data-live-search="true" data-live-search-placeholder="Procurar...">
                                        <option value="0">Domingo</option>
                                        <option value="1">Segunda-feira</option>
                                        <option value="2">Terça-feira</option>
                                        <option value="3">Quarta-feira</option>
                                        <option value="4">Quinta-feira</option>
                                        <option value="5">Sexta-feira</option>
                                        <option value="6">Sábado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="starttime">Ínicio</label>
                                    <input type="time" class="form-control" id="starttime" name="starttime" min="07:00:00" max="18:00:00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="endtime">Término</label>
                                    <input type="time" class="form-control" id="endtime" name="endtime" min="07:00:00" max="18:00:00">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary align-middle btn-lg">Buscar</button>
                        </div>
                    </div>
                </form>
                <div class="form-footer">
                    <div class="row">
                        @foreach($sportClasses as $sportClass)
                        <div class="col-md-4">
                            <div class="course-1-item">
                                <figure class="thumnail">
                                    <div class="category text-center"><h3>{{ $sportClass->sport_name }}</h3></div>
                                </figure>
                                <div class="course-1-content pb-4">
                                    <h2>Turma {{ $sportClass->name }}</h2>
                                    <p class="desc m-0">{{ $sportClass->teacher_name }}</p>
                                    <p class="desc mb-4">{{ $sportClass->sport_time }}</p>
                                    <p><a href="javascript:;"
                                          class="btn btn-primary rounded-0 px-4 confirm" data-id="{{ $sportClass->id }}">Inscrever-se na turma</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ (old('sport')) }}
                    {{ $sportClasses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.11/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $('.selectpicker').selectpicker();

        $('.confirm').on( "click", function(e) {

            e.preventDefault();

            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                width: 500,
                padding: '2.5rem',
                heightAuto: false,
                showCancelButton: true,
                confirmButtonText: 'Sim, inscrever-me!',
                cancelButtonText: 'Cancelar',
                showCloseButton: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:`/dashboard/student/enroll`,
                        method: 'POST',
                        data: {'id': id},
                        cache: false,
                        dataType: "json",
                        success:function() {
                            Swal.fire({
                                title: 'Inscrito com sucesso',
                                text: 'Você entrou na turma desejada.',
                                icon: 'success',
                                width: 500,
                                padding: '2.5rem',
                                heightAuto: false,
                                showCloseButton: true,
                            }).then((result) => {
                                if (result.value) {
                                    location.replace('/dashboard');
                                }
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
