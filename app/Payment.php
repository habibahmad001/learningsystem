<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use \App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
	protected $table = 'payments';
    use SoftDeletes;
  

    public static function getRecordWithSlug($slug)
    {
        return Payment::where('slug', '=', $slug)->first();
    }

    public function updateTransactionRecords($records_type)
    {
        $records = \DB::table('payments')
         ->where('created_at', '>=', \Carbon\Carbon::now()->subHour())
//        ->where('updated_at', '>', 'DATE_SUB(NOW(),INTERVAL -1 HOUR)')
        ->where('payment_status', '=', PAYMENT_STATUS_PENDING);
        
        if($records_type=='online')
        {
            $records->where('payment_gateway','!=','offline');
        }
        else if($records_type=='offline')
        {
            $records->where('payment_gateway','=','offline');   
        }
        else {
            $records->where('user_id','=',$records_type);      
        }
        
        return $records->get();
    }

    /**
     * This method checks the item is purchased or not
     * If purchased, it validates the date is valid to use
     * If valid, it return TRUE
     * ELSE it returns FALSE
     * @param  [type]  $item_id   [description]
     * @param  string  $item_type [description]
     * @param  string  $user_id   [description]
     * @return boolean            [description]
     */
    public static function isCertificatePaid($item_id, $item_type = 'combo', $user_id='')
    {
        if($user_id=='')
            $user_id = Auth::user()->id;

        $date = date('Y-m-d');
        $count = 0;

        $subscription_records = Payment::where('start_date','<=',$date)
            ->where('end_date','>=',$date)
            ->where('user_id','=',$user_id)
            ->where('plan_type','=','certificate-fee')
            ->get();
        if($subscription_records->count() ) {

            foreach ($subscription_records as $record) {

                $cflag = false;
                $certflag = false;
                $payment_courses = App\UserCourses::where('item_id', '=', $item_id)
                    ->where('user_id', '=', $user_id)
                    ->get();
                if ($payment_courses->count())
                    $cflag = TRUE;
                $cer = Certificate::where('user_id', '=', $user_id)
                    ->where('course_id', '=', $item_id)
                    ->where('transaction_id', '!=', '')
                    ->get();
                if ($cer->count())
                    $certflag = TRUE;
                if ($cflag && $certflag) {
                    return true;
                } else {
                    return false;
                }

            }
        }else{
            return false;
        }

        return FALSE;

    }




    public static function isItemPurchased($item_id, $item_type = 'combo', $user_id='')
    {
        if($user_id=='')
            $user_id = Auth::user()->id;
        
          $date = date('Y-m-d');
        $count = 0;

        $subscription_records = Payment::where('start_date','<=',$date)
                          ->where('end_date','>=',$date)
                          ->where('user_id','=',$user_id)
                          //->where('payment_gateway','!=','offline')
                          ->get();

        foreach($subscription_records as $record)
        {


            if($record->plan_type == 'combo') {
               if($item_type == $record->plan_type)
               {
                
                    if($item_id == $record->item_id)
                        return TRUE;
               }

              if($item_type == 'exam' )
              {
                 $combo_record = App\ExamSeries::where('id','=',$record->item_id)->first();
                $combo_data = DB::table('examseries_data')->select('*')
                ->where('examseries_id','=',$combo_record->id)
                ->where('quiz_id','=',$item_id)
                ->get();
                if($combo_data)
                    return TRUE;
              }
 
            }

            else if($record->plan_type == 'exam')
            {
                if($record->item_id == $item_id ){
                
                    return TRUE;
                }
            }
            else if($record->plan_type == 'lms')
            {

                $payment_courses = App\UserCourses::where('item_id','=',$item_id)
                    ->where('user_id','=',$user_id)
                    ->get();

                if($payment_courses->count() )
                    return TRUE;
            }
            else if($record->plan_type == 'certificate-fee' && $record->payment_gateway != 'offline')
            {

                $cflag=false;
                $certflag=false;
                $payment_courses = App\UserCourses::where('item_id','=',$item_id)
                    ->where('user_id','=',$user_id)
                    ->get();

                if($payment_courses->count() )
                    $cflag=TRUE;

                $cer = Certificate::where('user_id','=',$user_id)
                    ->where('course_id','=',$item_id)
                    ->where('transaction_id','!=','')
                    ->get();
                if($cer->count() )
                    $certflag=TRUE;

                if($cflag && $certflag){
                    return true;
                }else{
                    return false;
                }

            }
            else if($record->plan_type == 'studentcard-fee')
            {
                return true;
            }


        }

        return FALSE;

    }

    /**
     * This method returns the overall success, pending and failed records as summary
     * @return [type] [description]
     */
    public function getSuccessFailedCount()
    {
        $data = [];
        $data['success_count']      = Payment::where('payment_status','=','success')->count();
        $data['cancelled_count']    = Payment::where('payment_status','=','cancelled')->count();
        $data['pending_count']      = Payment::where('payment_status','=','pending')->count();
        return $data;
    }

    /**
     * This method gets the overall reports of the payments group by monthly
     * @param  string $year           [description]
     * @param  string $gateway        [description]
     * @param  string $payment_status [description]
     * @return [type]                 [description]
     */
    public function getSuccessMonthlyData($year='', $gateway='',$symbol='=' ,$payment_status='success')
    {
        if($year=='')
            $year = date('Y');

        $query = 'select sum(paid_amount) as total, sum(cost) as cost, MONTHNAME(created_at) as month from payments  where YEAR(created_at) = '.$year.' and payment_status = "'.$payment_status.'" group by YEAR(created_at), MONTH(created_at)';
        if($gateway!='')
        {
            $query = 'select sum(paid_amount) as total, MONTHNAME(created_at) as month from payments  where YEAR(created_at) = '.$year.' and payment_status = "'.$payment_status.'" and payment_gateway '.$symbol.' "'.$gateway.'" group by YEAR(created_at), MONTH(created_at)';
        }

        $result = DB::select($query);
        // dd($result);
        return $result;
    }

     /**
     * This method checks the item is purchased or not
     * If purchased, it validates the date is valid to use
     * If valid, it return TRUE
     * ELSE it returns FALSE
     * @param  [type]  $item_id   [description]
     * @param  string  $item_type [description]
     * @param  string  $user_id   [description]
     * @return boolean            [description]
     */
    public static function isParentPurchased($item_id, $item_type = 'combo', $user_id='')
    {
        if($user_id=='')
            $user_id = Auth::user()->id;
        
          $date = date('Y-m-d');
        $count = 0;

    
        
        $subscription_records = Payment::where('start_date','<=',$date)
                          ->where('end_date','>=',$date)
                          ->where('user_id','=',$user_id)
                          ->get();
 
        foreach($subscription_records as $record)
        {
            if($record->plan_type == 'combo') {
               if($item_type == $record->plan_type)
               {
                
                    if($item_id == $record->item_id)
                        return 'purchased';
               }

              if($item_type == 'exam' )
              {
                 $combo_record = App\ExamSeries::where('id','=',$record->item_id)->first();
                $combo_data = DB::table('examseries_data')->select('*')
                ->where('examseries_id','=',$combo_record->id)
                ->where('quiz_id','=',$item_id)
                ->get();
                if($combo_data)
                    return 'purchased';
              }
 
            }

            else if($record->plan_type == 'exam')
            {
                if($record->item_id == $item_id ){
                
                    return 'purchased';
                }
            }
            else if($record->plan_type == 'lms')
            {
                if($record->item_id == $item_id )
                    return 'purchased';
            }


        }  
        return 'notpurchased';

    }
    public function getCreatedAtAttribute($value)
    {
        return date('F j, Y, g:i a', strtotime($value));
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
        return $this->belongsTo('App\LmsSeries','item_id','id');
    }
    
}
