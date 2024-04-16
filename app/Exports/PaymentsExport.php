<?php

namespace App\Exports;

use App\Payment;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function __construct($from, $to, $payment = false, $plantype = false)
    {
        $this->from = (strtotime($from) == strtotime($to)) ? date('Y-m-d H:i:s', strtotime($from . ' -1 day')) : $from;
//        $this->to = (strtotime($from) == strtotime($to)) ? date('Y-m-d H:i:s', strtotime($to . ' +1 day')) : $to;
//        $this->from = date('Y-m-d H:i:s', strtotime($from . ' -1 day'));
        $this->to = date('Y-m-d H:i:s', strtotime($to . ' +1 day'));
//        $this->from = $from;
//        $this->to = $to;
        $this->payment = ($payment == "all") ? false : $payment;
        $this->plantype = ($plantype == "all") ? false : $plantype;
    }

    public function query()
    {
        $record = Payment::query()
            ->join('users', 'users.id','=','payments.user_id')
            ->join('couponcodes', 'couponcodes.id','=','payments.coupon_id')
            ->select(['payments.id', 'item_name', 'start_date', 'end_date', 'payment_gateway','plan_type', 'transaction_id', 'payment_status', 'payments.cost', 'payments.discount_amount', 'payments.actual_cost', 'couponcodes.coupon_code', 'users.name', 'users.email'])
            ->whereBetween('payments.created_at', [$this->from, $this->to])
            ->orderBy('payments.updated_at', 'desc');
        if($this->payment) {
            $record->where('payments.payment_gateway', $this->payment);
        }

        if($this->plantype) {
            $record->where('payments.plan_type', $this->plantype);
        }
        return $record;
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Course Name',
            'Start Date',
            'End Date',
            'Payment Gateway',
            'Plan Type',
            'Transaction ID',
            'Payment Status',
            'Order Total',
            'Discount Availed',
            'Actual Cost',
            'Coupon Applied',
            'User Name',
            'User Email',
        ];
    }
}
