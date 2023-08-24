<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaccoMember;
use App\Models\SaccoDeposit; 

class SearchController extends Controller
{
    //serch method 
   public function search(Request $request)
    {
        $route = $request->input('route');
        $query = $request->input('query');
        

        $searchResults = [];


        //dd($query);
        //exit(0);
        if ($route === 'deposits') {
            // Search the Deposit model
            $searchResults = SaccoDeposit::where('Username', 'like', '%' . $query . '%')
                ->orWhere('amount', 'like', '%' . $query . '%')
                ->orWhere('dateDeposited', 'like', '%' . $query . '%')
                ->orWhere('receiptNumber', 'like', '%' . $query . '%')
                ->get();
                
                
                
                
        } elseif ($route === 'saccomembers') {
            // Search the Member model
            $searchResults = SaccoMember::where('Username', 'like', '%' . $query . '%')
                
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('phoneNumber', 'like', '%' . $query . '%')
                ->orWhere('MemberNumber', 'like', '%' . $query . '%')
                ->orWhere('accountBalance', 'like', '%' . $query . '%')
                ->get();


            
                

        }

        //dd($searchResults);     
        //exit(0);

        return view('pages.search_results', ['route' => $route, 'searchResults' => $searchResults]);
    }


    

}
