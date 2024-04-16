<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{

    public $timestamps = true;

    protected $table = 'logs';

    protected $dates = ['created_at','updated_at'];

	protected $fillable = ['user_id', 'operation_id', 'table_name', 'message', 'data_json', 'model_json', 'status'];

    public static function CreateLog($data = '')
    {
        $log    =   new Logs();

        $log->user_id       =   $data->user_id;
        $log->operation_id  =   $data->operation_id;
        $log->table_name    =   $data->table_name;
        $log->message       =   $data->message;
        $log->data_json     =   $data->data_json;
        $log->model_json    =   $data->model_json;

        $log->save();
    }

}