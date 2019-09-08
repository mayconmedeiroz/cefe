<?php

namespace CEFE\Imports;

use CEFE\SchoolClass;
use CEFE\User;
use CEFE\StudentSchoolClass;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
{
    private $school_year;
    private $school;

    public function __construct($school_year, $school)
    {
        $this->school_year = $school_year;
        $this->school = $school;
    }

    public function headingRow(): int
    {
        return 9;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'nome'      => 'required',
            'matricula' => 'required',
            'cpf'       => 'required', #|numeric
            'turma'     => 'required|numeric',
            'numero'    => 'required|numeric'
        ];
    }

    public function model(array $row)
    {
        if (!$user = User::where('enrollment', $row['matricula'])->first())
        {
            $user = User::create([
                'name'              => mb_convert_case($row['nome'], MB_CASE_TITLE, "UTF-8"),
                'enrollment'        => $row['matricula'],
                'password'          => Hash::make($row['cpf']),
                'updated_at'        => NULL,
            ]);
        }

        $school_class = SchoolClass::where('class', $row['turma'])->where('school_id', $this->school)->first();

        # Ver a possibilidade da retirada dessa linha.
        StudentSchoolClass::where('student_id', $user->id)->where('school_year_id', '!=', $this->school_year)->delete();

        StudentSchoolClass::updateOrCreate(
            [
                'student_id'        => $user->id,
                'school_year_id'    => $this->school_year,
            ],
            [
                'student_id'        => $user->id,
                'school_class_id'   => $school_class->id,
                'class_number'      => $row['numero'],
                'school_year_id'    => $this->school_year,
            ]
        );
    }

}
