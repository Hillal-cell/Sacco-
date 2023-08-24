<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\SaccoMember;

class SaccoMembersController extends Controller
{
    public function members()
    {
        $members = SaccoMember::all(); 
        return view("pages.sacco-members", ['members' => $members]);
    }


   public function upload(Request $request)
    {
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
            $member = new SaccoMember();

            // Set the member attributes from the CSV data
            $member->Username = $data['Username'];
            $member->email = $data['email'];
            $member->password = $data['password'];
            
            // Manipulate the phone number as needed (e.g., truncate to 10 digits)
            $rawPhoneNumber = $data['phoneNumber'];
            $formattedPhoneNumber = substr($rawPhoneNumber, 0, 9); // Keep first 9 digits
            $member->phoneNumber = $formattedPhoneNumber;


            $member->MemberNumber = $data['MemberNumber'];
            $member->accountBalance = $data['accountBalance'];

            // Save the member record
            $member->save();
        }

        fclose($file);

        // Redirect or display a success message
        return redirect()->back()->with('success', 'Members uploaded successfully.');
    }

    private function generateColumnMapping($csvHeaders)
    {
        $tableColumns = [
            'Username', 'email', 'password', 'phoneNumber', 'MemberNumber', 'accountBalance'
        ]; // Replace with your actual column names

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





}


