<?php

namespace App\Http\Controllers;

use App\Models\SaccoDeposit;
use Illuminate\Http\Request;
use App\Models\SaccoActiveLoan;

class SaccoDepositsController extends Controller
{
    public function deposits()
    {
        


        $deposits = SaccoDeposit::all(); 
        return view("pages.sacco-deposits", ['deposits' => $deposits]);


    }

    
    public function upload(Request $request)
    {
        try{
        // Get file
        $upload = $request->file('upload-file');
        $filePath = $upload->getRealPath();

        // Open and read the file
        $file = fopen($filePath, 'r');

        // Read the CSV header
        $csvHeader = fgetcsv($file);

        // Generate a column mapping based on case-insensitive CSV headers
        $columnMapping = $this->generateColumnMapping($csvHeader);

        // Loop through the columns
        while ($columns = fgetcsv($file)) {
            if ($columns[0] == "") {
                continue;
            }

            // Create an associative array by combining column mapping with CSV values
            $data = array_combine($columnMapping, $columns);

            // Create a new SaccoMember instance
            $deposit = new SaccoDeposit();

            // Set the member attributes from the CSV data
            $deposit->Username = $data['Username'];
            $deposit->amount = $data['amount'];
            // Format the date before saving
            $deposit->dateDeposited = date('Y-m-d', strtotime($data['dateDeposited']));
            $deposit->receiptNumber = $data['receiptNumber'];
            

            // Save the member record
            $deposit->save();
        }

        fclose($file);

          // Redirect or display a success message
        return redirect()->back()->with('success', 'Deposits uploaded successfully.');
        } catch (QueryException $e) {
        // Handle integrity constraint violations
        $errorCode = $e->getCode();

        if ($errorCode === 23000) {
            // Integrity constraint violation
            return redirect()->back()->with('error', 'Integrity constraint violation. Please check your data.');
        }

        // Other database error
        return redirect()->back()->with('error', 'An error occurred while uploading deposits.');
        }
    }



    private function generateColumnMapping($csvHeaders)
    {
        $tableColumns = [
            'Username', 'amount', 'dateDeposited', 'receiptNumber'
        ];

        $mapping = [];
        foreach ($csvHeaders as $csvHeader) {
            $csvHeaderLower = strtolower($csvHeader);
            foreach ($tableColumns as $tableColumn) {
                if (strpos($csvHeaderLower, strtolower($tableColumn)) !== false) {
                    $mapping[] = $tableColumn;
                    break;
                }
            }
        }

        return $mapping;
    }



    public function searchDeposit()
    {
        $search_text = $_GET['query'];

        // Check if the search text is a valid integer (for receipt number) or a string (for member ID)
        if (is_numeric($search_text) ) {
            $searchdeposits = Deposit::where('receiptNumber', 'LIKE', $search_text . '%')->get();
        } else  {
            $searchdeposits = Deposit::where(function ($query) use ($search_text) {
                $query->where('userid', 'LIKE', "%{$search_text}%")
                    ->orWhereDate('dateDeposited', $search_text); 
            })->get();

        }
        $deposits = Deposit::all();

        return view('pages.sacco-deposits', ['deposits' => $deposits, 'searchdeposits' => $searchdeposits]);

       // return view('pages/searchdeposit', compact('searchdeposits'));
    
        // Now you can use $deposits to access the search results
    }



}
