<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaccoIssue;

class SaccoIssuesController extends Controller
{
    public function issues()
    {   
        $issues = SaccoIssue::all();
        return view('pages.sacco-issues',['issues'=>$issues]);
    }
}
