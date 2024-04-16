<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LmsSeriesSections extends Model
{
    protected $table = 'lmsseries_sections';

    public function contents()
    {
        return $this->belongsToMany('App\LmsContent', 'lmsseries_data',
            'section_id', 'lmscontent_id');
    }

    public function exams()
    {
        return $this->belongsToMany('App\Quiz', 'lmsseries_exams',
            'section_id', 'exam_quiz_id');
    }

}
