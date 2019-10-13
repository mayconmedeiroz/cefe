<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('<i class="fas fa-home"></i> Dashboard', route('dashboard'));
});

// Dashboard > Meu Perfil
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Meu Perfil');
});

// Dashboard > Reportar BUG
Breadcrumbs::for('report', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Reportar um Problema');
});

// Dashboard > Funcionário > Gerenciar Turmas
Breadcrumbs::for('employee.sport_classes.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Turmas', route('employee.sport_classes.index'));
});

// Dashboard > Funcionário > Gerenciar Alunos
Breadcrumbs::for('employee.students.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Alunos');
});

// Dashboard > Funcionário > Gerenciar Modalidades
Breadcrumbs::for('employee.sports.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Modalidades');
});

// Dashboard > Funcionário > Gerenciar Professores
Breadcrumbs::for('employee.teachers.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Professores');
});

// Dashboard > Funcionário > Gerenciar Secretários
Breadcrumbs::for('employee.secretaries.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Secretários');
});

// Dashboard > Funcionário > Gerenciar Funcionários
Breadcrumbs::for('employee.employees.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Funcionários');
});

// Dashboard > Funcionário > Gerenciar Turmas > Turma {id}
Breadcrumbs::for('employee.class.index', function ($trail, $classes) {
    $trail->parent('employee.sport_classes.index');
    $trail->push('Turma ' . $classes);
});

// Dashboard > Funcionário > Lançamento de Notas
Breadcrumbs::for('employee.grades.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Lançamento de Notas');
});

// Dashboard > Funcionário > Boletim
Breadcrumbs::for('employee.report_cards.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Boletim');
});

// Dashboard > Funcionário > Importar Estudantes
Breadcrumbs::for('employee.import_students.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Importar Estudantes');
});

// Dashboard > Funcionário > Gerenciar Notícias
Breadcrumbs::for('employee.articles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Notícias');
});

// Dashboard > Funcionário > Gerenciar Categorias
Breadcrumbs::for('employee.categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Categorias');
});

// Dashboard > Secretaria > Gerenciar Alunos
Breadcrumbs::for('secretary.students.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Alunos');
});

// Dashboard > Secretaria > Boletim
Breadcrumbs::for('secretary.report_cards.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Boletim');
});

// Dashboard > Secretaria > Importar Estudantes
Breadcrumbs::for('secretary.import_students.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Importar Estudantes');
});

// Dashboard > Professor > Gerenciar Turmas
Breadcrumbs::for('teacher.sport_classes.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Turmas', route('teacher.sport_classes.index'));
});

// Dashboard > Professor > Gerenciar Turmas > Turma {id}
Breadcrumbs::for('teacher.class.index', function ($trail, $classes) {
    $trail->parent('teacher.sport_classes.index');
    $trail->push('Turma ' . $classes);
});

// Dashboard > Professor > Lançamento de Notas
Breadcrumbs::for('teacher.grades.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Lançamento de Notas');
});

// Dashboard > Estudante > Inscrever-se em uma modalidade
Breadcrumbs::for('student.enroll.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Inscrever-se em uma modalidade');
});

// Dashboard > Estudante > Boletim
Breadcrumbs::for('student.studentReportCardIndex', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Boletim');
});

// Dashboard > Estudante > Solicitar troca de modalidade
Breadcrumbs::for('student.request_exchange', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Solicitar troca de modalidade');
});
