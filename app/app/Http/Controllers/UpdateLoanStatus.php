<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaccoLoanRequest;

class UpdateLoanStatus extends Controller
{
    //method to change the loan status from Processing to active
    
    public function updateLoanStatus(Request $request, $loanId) {
    
    $loanrequests = SaccoLoanRequest::findOrFail($loanId);

    // Update the LoanStatus from "Processing" to "Active"
    if ($loanrequests->LoanStatus === 'Processing') {
        $loanrequests->LoanStatus = 'Active';
        $loanrequests->save();
        return response()->json(['success' => true]);
    }

    //return response()->json(['success' => false, 'message' => 'Loan status cannot be changed.']);

    
}
}
