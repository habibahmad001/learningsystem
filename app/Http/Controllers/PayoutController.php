<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PendingPayout;

class PayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pending()
    {

        $data['active_class'] = 'My Revenue';
        $data['title'] = getPhrase('Pending Payouts ');
        $payout = PendingPayout::with('user', 'courses','order')->where('status', '0')->get();

         $data['payout']=$payout;
        //dd($data);
        return view(getTheme() . '::instructors.revenue.pending',$data);



    }
}
