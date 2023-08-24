<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaccoLoanRequest;

class SaccoLoanRequestsController extends Controller
{
    public function LoanRequests(){
        $loanrequests = SaccoLoanRequest::all();
        return view('pages.sacco-loanrequests',['loanrequests'=>$loanrequests]);
    }
}
