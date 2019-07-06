<?php

// Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('<i class="fas fa-home"></i> Dashboard', route('dashboard'));
});

// Dashboard > Meu Perfil
Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Meu Perfil', route('profile'));
});

// Dashboard > Gerenciar Turmas
Breadcrumbs::for('sport_classes.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Turmas', route('sport_classes.index'));
});

// Dashboard > Gerenciar Alunos
Breadcrumbs::for('students.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Alunos');
});

// Dashboard > Gerenciar Modalidades
Breadcrumbs::for('sports.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Modalidades', route('sports.index'));
});

// Dashboard > Gerenciar Professores
Breadcrumbs::for('teachers.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Professores');
});

// Dashboard > Gerenciar Funcionários
Breadcrumbs::for('employees.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Gerenciar Funcionários');
});

// Dashboard > Gerenciar Turmas > Turma {id}
Breadcrumbs::for('class.index', function ($trail, $classes) {
    $trail->parent('sport_classes.index');
    $trail->push('Turma ' . $classes);
});

// Dashboard > Lançamento de Notas
Breadcrumbs::for('grades.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Lançamento de Notas');
});

// Dashboard > Boletim
Breadcrumbs::for('report_cards.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Boletim');
});


// Dashboard > Importar Estudantes
Breadcrumbs::for('import_students.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Importar Estudantes');
});