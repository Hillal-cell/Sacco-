<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaccoActiveLoan;

class SaccoLoansController extends Controller
{
    public function Loans()
    {
        


        $loans = SaccoActiveLoan::all();
        return view('pages.sacco-activeloans',['loans' => $loans]);


    }
}
