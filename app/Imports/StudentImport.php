<?php

namespace CEFE\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use CEFE\User;
use Illuminate\Support\Facades\DB;
use Hash;
use CEFE\StudentSchoolClass;

class StudentImport implements ToCollection
{
    private $school_year;
    private $school;

    public function __construct($school_year, $school)
    {
        $this->school_year = $school_year;
        $this->school = $school;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $user = User::where('enrollment', $row[1])->first();
            $school_class = DB::table('school_classes')
                ->where('class', $row[3])
                ->where('school_id', $this->school)
                ->first();

            if ($user) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'name'              => mb_convert_case(mb_strtolower($row[0], "UTF-8"), MB_CASE_TITLE, "UTF-8"),
                        'enrollment'        => $row[1],
                    ]);

                $student = DB::table('students')
                    ->where('user_id', $user->id)
                    ->first();

                StudentSchoolClass::where('student_id', $student->id)->delete();

                StudentSchoolClass::create([
                    'student_id'        => $student->id,
                    'school_class_id'   => $school_class->id,
                    'class_number'      => $row[4],
                    'school_year_id'    => $this->school_year
                ]);

            } else {
                $userId = DB::table('users')->insertGetId([
                    'name'              => mb_convert_case(mb_strtolower($row[0], "UTF-8"), MB_CASE_TITLE, "UTF-8"),
                    'enrollment'        => $row[1],
                    'password'          => Hash::make($row[2]),
                    'created_at'        => \Carbon\Carbon::now(),
                ]);

                $student = DB::table('students')->insertGetId([
                    'user_id'           => $userId,
                    'created_at'        => \Carbon\Carbon::now(),
                    'updated_at'        => \Carbon\Carbon::now(),
                ]);

                StudentSchoolClass::create([
                    'student_id'        => $student,
                    'school_class_id'   => $school_class->id,
                    'class_number'      => $row[4],
                    'school_year_id'    => $this->school_year
                ]);
            }
        }
    }
}