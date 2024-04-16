<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompletedPayout;
use Auth;

class CompletedPayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {

        $data['active_class'] = 'My Revenue';
        $data['title'] = getPhrase('Completed Payouts ');

//        if(Auth::user()->role == 'admin' )
//        {
//        	$payout = CompletedPayout::get();
//        }
//        else
//        {
//            $payout = CompletedPayout::where('user_id', Auth::User()->id)->get();
//        }

        $payout = CompletedPayout::where('user_id', Auth::User()->id)->get();
        $data['payout'] = $payout;
        return view(getTheme() . '::instructors.revenue.completed',$data);
    }

    public function view($id)
    {
        $data['active_class'] = 'My Revenue';
        $data['title'] = getPhrase('Preview Payouts ');
    	$payout = CompletedPayout::where('id', $id)->first();
        $data['payout'] = $payout;
        $view_name = getTheme().'::instructors.revenue.view';
        return view($view_name, $data);

    }
}
