<?php

namespace App\Exports;

use App\SchoolClass;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ReportCardPerSchoolExport implements WithMultipleSheets
{

    private $evaluation;
    private $school_id;
    private $school_year;

    public function __construct(int $evaluation, int $school_id, int $school_year)
    {
        $this->evaluation = $evaluation;
        $this->school_id = $school_id;
        $this->school_year = $school_year;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $count = SchoolClass::where('school_id', $this->school_id)->count();
        $data = DB::table('school_classes')
            ->select( 'school_classes.class')
            ->join('schools', function($join){
                $join->where('schools.id', $this->school_id);
            })
            ->get();

        $sheets = [];

        for ($class = 1; $class <= $count; $class++) {
            $sheets[] = new ReportCardPerSchoolSheet($this->evaluation, $this->school_id, $class, $this->school_year, $data[$class-1]->class);
        }

        return $sheets;
    }
}