@php

switch (Auth::user()->level) {
    case 1:
    #\*App\StudentController::hasSportClass()
        if (1 == '1')
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
@endphp
<div class="aside-menu-wrapper grid-item grid-item-fluid">
    <div class="aside-menu">
        <ul class="menu-nav">
            <li class="menu-item {{ Request::is('dashboard') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <span class="menu-link-icon"><i class="fa fa-home"></i></span>
                    <span class="menu-link-text">Painel de Controle</span>
                </a>
            </li>
            <li class="menu-item {{ Request::is('*/report') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                <a href="{{ route('report') }}" class="menu-link">
                    <span class="menu-link-icon"><i class="fa fa-bug"></i></span>
                    <span class="menu-link-text">Reportar um Problema</span>
                </a>
            </li>
            @switch(Auth::user()->level)
                @case(4)
                    <li class="menu-section">
                        <h4 class="menu-section-text">Administração Funcionário</h4>
                    </li>
                    <li class="menu-item {{ Request::is('*/employees') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.employees.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-user"></i></span>
                            <span class="menu-link-text">Gerenciar Funcionários</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/secretaries') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.secretaries.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-id-card-alt"></i></span>
                            <span class="menu-link-text">Gerenciar Secretários</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/teachers') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.teachers.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-chalkboard-teacher"></i></span>
                            <span class="menu-link-text">Gerenciar Professores</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/sports') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.sports.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-baseball-ball"></i></span>
                            <span class="menu-link-text">Gerenciar Modalidades</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/schools') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.schools.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-university"></i></span>
                            <span class="menu-link-text">Gerenciar Escolas</span>
                        </a>
                    </li>
                    <li class="menu-section">
                        <h4 class="menu-section-text">Administração Secretário</h4>
                    </li>
                    <li class="menu-item {{ Request::is('*/students') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.students.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-user-graduate"></i></span>
                            <span class="menu-link-text">Gerenciar Alunos</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/report_cards') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.report_cards.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-id-badge"></i></span>
                            <span class="menu-link-text">Boletim</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/import_students') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.import_students.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-address-card"></i></span>
                            <span class="menu-link-text">Importar Alunos</span>
                        </a>
                    </li>
                    <li class="menu-section">
                        <h4 class="menu-section-text">Administração Professor</h4>
                    </li>
                    <li class="menu-item {{ (Request::is('*/sport_classes') || Request::is('*/class/*')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.sport_classes.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-chalkboard"></i></span>
                            <span class="menu-link-text">Gerenciar Turmas</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/grades') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.grades.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-address-card"></i></span>
                            <span class="menu-link-text">Lançamento de Notas</span>
                        </a>
                    </li>
                    <li class="menu-section">
                        <h4 class="menu-section-text">Administração Notícias</h4>
                    </li>
                    <li class="menu-item {{ Request::is('*/articles') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.articles.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-newspaper"></i></span>
                            <span class="menu-link-text">Gerenciar Notícias</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/categories') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('employee.categories.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-newspaper"></i></span>
                            <span class="menu-link-text">Gerenciar Categorias</span>
                        </a>
                    </li>
                @break
                @case(3)
                    <li class="menu-section">
                        <h4 class="menu-section-text">Administração Secretário</h4>
                    </li>
                    <li class="menu-item {{ Request::is('*/students') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('secretary.students.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-user-graduate"></i></span>
                            <span class="menu-link-text">Gerenciar Alunos</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/report_cards') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('secretary.report_cards.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-id-badge"></i></span>
                            <span class="menu-link-text">Boletim</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/import_students') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('secretary.import_students.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-address-card"></i></span>
                            <span class="menu-link-text">Importar Alunos</span>
                        </a>
                    </li>
                @break
                @case(2)
                    <li class="menu-section">
                        <h4 class="menu-section-text">Administração Professor</h4>
                    </li>
                    <li class="menu-item {{ (Request::is('*/sport_classes') || Request::is('*/class/*')) ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('teacher.sport_classes.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-chalkboard"></i></span>
                            <span class="menu-link-text">Gerenciar Turmas</span>
                        </a>
                    </li>
                    <li class="menu-item {{ Request::is('*/grades') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('teacher.grades.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-address-card"></i></span>
                            <span class="menu-link-text">Lançamento de Notas</span>
                        </a>
                    </li>
                @break
                @case(1)
                    @if($data['hasSportClass'] || ( $data['hasSportClass'] > 1 && $data['recuperation'] ))
                    <li class="menu-item {{ Request::is('*/enroll') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('student.enroll.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-chalkboard"></i></span>
                            <span class="menu-link-text">Trocar modalidade</span>
                        </a>
                    </li>
                    @else
                    <li class="menu-item {{ Request::is('*/enroll') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('student.enroll.index') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-chalkboard"></i></span>
                            <span class="menu-link-text">Inscrever-se em uma modalidade</span>
                        </a>
                    </li>
                    @endif
                    <li class="menu-item {{ Request::is('*/report_card') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('student.studentReportCardIndex') }}" class="menu-link menu-toggle">
                            <span class="menu-link-icon"><i class="fa fa-address-card"></i></span>
                            <span class="menu-link-text">Boletim</span>
                        </a>
                    </li>
                @break
            @endswitch
        </ul>
    </div>
</div>
