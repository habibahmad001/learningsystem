<?php

namespace App\Imports;

use App\Subject;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class SubjectsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Subject|null
     */
    public function model(array $row)
    {
//        print_r($row); exit();
        return new Subject([
            'subject_title'    => $row['subject_title'],
            'subject_code'    => $row['subject_code'],
            'slug'    => $row['slug'],
            'status'    => 'Active',
            'maximum_marks'    => 0,
            'pass_marks'    => 0,
            'is_lab'    => 0,
            'is_elective_type'    => 0,
        ]);
    }
}