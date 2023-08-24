<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class ReportController extends Controller
{
    public function generatePDF()
    {
        $saccoDeposits = DB::table('sacco_deposits')->get();
        $saccoIssues = DB::table('sacco_issues')->get();
        $saccoLoanRequests = DB::table('sacco_loan_requests')->get();
        $saccoMembers = DB::table('sacco_members')->get();
        $saccoActiveLoans = DB::table('sacco_active_loans')->get();

        $data = [
            'saccoDeposits' => $saccoDeposits,
            'saccoIssues' => $saccoIssues,
            'saccoLoanRequests' => $saccoLoanRequests,
            'saccoMembers' => $saccoMembers,
            'saccoActiveLoans' => $saccoActiveLoans,
            // ... other data you want to include in the report
        ];


        
        // Create an instance of the PDF class
        $pdf = app('dompdf.wrapper'); 

        // Load the view into the PDF instance
        $pdf->loadView('pdf.report', $data);

        // Save the PDF to a temporary file
        $pdfPath = storage_path('app/temp/report.pdf');
        $pdf->save($pdfPath);

        // Send the email with the attached report
        $recipientEmail = 'sayrunjogi@gmail.com'; // Replace with the recipient's email address
        Mail::to($recipientEmail)->send(new HelloMail ($pdfPath)); // Send the email

        return "PDF generated and email sent successfully!";
    }
}
