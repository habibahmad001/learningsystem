<?php

namespace App\Imports;

use App\Topic;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class TopicsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Topic|null
     */
    public function model(array $row)
    {

        return new Topic([
            'subject_id'    => $row['subject_id'],
            'parent_id'    => $row['parent_id'],
            'topic_name'    => $row['topic_name'],
            'description'    => $row['description'],
        ]);
    }
}