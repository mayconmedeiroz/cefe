<?php

namespace CEFE\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReportCardExport implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle
{

    private $evaluation;
    private $school_id;
    private $class;
    private $school_year;
    private $class_name;

    public function __construct(int $evaluation, int $school_id, int $class, int $school_year, int $class_name)
    {
        $this->evaluation = $evaluation;
        $this->school_id = $school_id;
        $this->class = $class;
        $this->school_year = $school_year;
        $this->class_name = $class_name;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = DB::table('users')
            ->select('users.name', 'school_classes.class', 'student_school_classes.class_number', 'student_grades.grade', 'recuperations.grade as recuperation_grade')
            ->selectRaw('CASE WHEN `absences`.`absences`="0" THEN "0.0" ELSE `absences`.`absences` END AS absences')
            ->selectRaw('CONCAT(100 - ROUND(((`absences`.`absences` * 100) / `sport_class_lessons`.`classes_held`), 2), "%") AS attendance')
            ->leftJoin('student_school_classes', function($join){
                $join->on('student_school_classes.student_id', '=', 'users.id')
                    ->whereNull('student_school_classes.deleted_at');
            })
            ->join('school_classes', function($join){
                $join->on('school_classes.id', '=', 'student_school_classes.school_class_id')
                    ->where('school_classes.school_id', $this->school_id)
                    ->where('school_classes.id', $this->class);
            })
            ->leftJoin('student_grades', function($join){
                $join->on('student_grades.student_id', '=', 'users.id')
                    ->where('student_grades.evaluation_id', $this->evaluation)
                    ->where('student_grades.school_year_id', $this->school_year);
            })
            ->leftJoin('student_classes', function($join){
                $join->on('student_classes.student_id', '=', 'users.id')
                    ->whereNull('student_classes.deleted_at');
            })
            ->leftJoin('sport_class_lessons', function($join){
                $join->on('sport_class_lessons.sport_class_id', '=', 'student_classes.sport_class_id')
                    ->where('sport_class_lessons.evaluation_id', $this->evaluation);
            })
            ->leftJoin('absences', 'absences.student_grade_id', '=', 'student_grades.id')
            ->leftJoin('recuperations', 'recuperations.student_grade_id', '=', 'student_grades.id')
            ->orderByRaw('`student_school_classes`.`class_number` + 0 ASC')
            ->get();

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nome',
            'Turma',
            'Número',
            'Nota da Avaliação',
            'Nota de Recuperação',
            'Faltas',
            'Frequência',
        ];
    }

    public function title(): string
    {
        return 'Turma ' . $this->class_name;
    }
}
