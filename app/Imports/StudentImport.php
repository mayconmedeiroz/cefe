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

                StudentSchoolClass::where('student_id', $user->id)->delete();

                StudentSchoolClass::create([
                    'student_id'        => $user->id,
                    'school_class_id'   => $school_class->id,
                    'class_number'      => $row[4],
                    'school_year_id'    => $this->school_year,
                ]);

            } else {
                $userId = DB::table('users')->insertGetId([
                    'name'              => mb_convert_case(mb_strtolower($row[0], "UTF-8"), MB_CASE_TITLE, "UTF-8"),
                    'enrollment'        => $row[1],
                    'password'          => Hash::make($row[2]),
                    'created_at'        => \Carbon\Carbon::now(),
                ]);

                StudentSchoolClass::create([
                    'student_id'        => $userId,
                    'school_class_id'   => $school_class->id,
                    'class_number'      => $row[4],
                    'school_year_id'    => $this->school_year,
                ]);
            }
        }
    }
}
