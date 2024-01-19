<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    function SalesReport(Request $request){
        $user_id=Auth::id();
        $FormDate=date('Y-m-d', strtotime($request->input->FormDete));
        $ToDate=date('Y-m-d', strtotime($request->input->ToDate));

        $total=Invoice::where('user_id',$user_id)->whereDate('created_at', '>=', $FormDate)->whereDate('created_at', '<=', $ToDate)->sum('total');
    }
}
