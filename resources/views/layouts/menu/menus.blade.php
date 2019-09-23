@php

switch (Auth::user()->level) {
    case 4:
        $menus =  [
            [
                'title'     => 'Gerenciar Turmas',
                'route'     => 'employee.sport_classes.index',
                'icon'      => 'fa-chalkboard',
            ],
            [
                'title'     => 'Gerenciar Alunos',
                'route'     => 'employee.students.index',
                'icon'      => 'fa-user-graduate',
            ],
            [
                'title'     => 'Lançamento de Notas',
                'route'     => 'employee.grades.index',
                'icon'      => 'fa-address-card',
            ],
            [
                'title'     => 'Gerenciar Modalidades',
                'route'     => 'employee.sports.index',
                'icon'      => 'fa-baseball-ball',
            ],
            [
                'title'     => 'Gerenciar Professores',
                'route'     => 'employee.teachers.index',
                'icon'      => 'fa-chalkboard-teacher',
            ],
            [
                'title'     => 'Gerenciar Secretários',
                'route'     => 'employee.secretaries.index',
                'icon'      => 'fa-id-card-alt',
            ],
            [
                'title'     => 'Gerenciar Funcionários',
                'route'     => 'employee.employees.index',
                'icon'      => 'fa-user',
            ],
            [
                'title'     => 'Boletim',
                'route'     => 'employee.report_cards.index',
                'icon'      => 'fa-id-badge',
            ],
            [
                'title'     => 'Importar Alunos',
                'route'     => 'employee.import_students.index',
                'icon'      => 'fa-address-card',
            ],
            [
                'title'     => 'Gerenciar Notícias',
                'route'     => 'employee.blog.index',
                'icon'      => 'fa-newspaper',
            ],
        ];
        break;
    case 3:
        $menus = [
            [
                'title'     => 'Gerenciar Alunos',
                'route'     => 'secretary.students.index',
                'icon'      => 'fa-user-graduate',
            ],
            [
                'title'     => 'Boletim',
                'route'     => 'secretary.report_cards.index',
                'icon'      => 'fa-id-badge',
            ],
            [
                'title'     => 'Importar Alunos',
                'route'     => 'secretary.import_students.index',
                'icon'      => 'fa-address-card',
            ],
        ];
        break;
    case 2:
        $menus = [
            [
                'title'     => 'Gerenciar Turmas',
                'route'     => 'teacher.sport_classes.index',
                'icon'      => 'fa-chalkboard',
            ],
            [
                'title'     => 'Lançamento de Notas',
                'route'     => 'teacher.grades.index',
                'icon'      => 'fa-address-card',
            ],
        ];
        break;
    case 1:
        if (\CEFE\Http\Controllers\StudentController::hasSportClass() == '1')
            $menus = [
                [
                    'title'     => 'Ver Notas',
                    'route'     => 'student.studentReportCardIndex',
                    'icon'      => 'fa-id-badge',
                ],
                [
                    'title'     => 'Solicitar troca de modalidade',
                    'route'     => 'student.request_exchange',
                    'icon'      => 'fa-frown',
                ],
            ];
        else {
            $menus = [
                [
                    'title'     => 'Inscrever-se em uma modalidade',
                    'route'     => 'student.enroll.index',
                    'icon'      => 'fa-address-card',
                ],
            ];
        }
        break;
}

$menus =  json_decode(json_encode($menus));

@endphp

@foreach($menus as $menu)
    <li>
        <a href="{{ route($menu->route) }}" {{ Route::current()->getName() == $menu->route ? 'class=menu-active' : '' }}>
            <i class="fas {{ $menu->icon }}"></i>
            <span>{{ $menu->title }}</span>
        </a>
    </li>
@endforeach
