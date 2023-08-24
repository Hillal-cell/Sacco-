<?php

namespace App\Http\Controllers;

use App\Models\SaccoIssue;
use App\Models\SaccoMember;
use App\Models\SaccoDeposit;
use Illuminate\Http\Request;
use App\Models\SaccoLoanRequest;
use App\Models\SaccoActiveLoan;
use Illuminate\Routing\Controller;




class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        

        
        $totalSaccoMembersbalances = SaccoMember::sum('accountBalance');
        $totalLoanclearences = SaccoActiveLoan::sum('Loan_Balance');
        $availableFunds = $totalSaccoMembersbalances-($totalLoanclearences ?? 0);
        
        //dd($availableFunds); 
        $totalSaccoMembers = SaccoMember::count();
        $deposits = SaccoDeposit::whereused(1)->count();
        $complaints = SaccoIssue::count();
        $totalLoanRequests = SaccoLoanRequest::count();



         


        //data for the graph
        $depositDataForGraph = SaccoDeposit::select('dateDeposited', 'amount')->get();
        
         // Fetch deposit data grouped by month
       $depositsByMonth = SaccoDeposit::selectRaw("YEAR(dateDeposited) as year, MONTH(dateDeposited) as month, COUNT(*) as count")
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();


        // Prepare data for graph
        $labels = [];
        $depositCounts = [];

        foreach ($depositsByMonth as $deposit) {
            $monthName = date("F", mktime(0, 0, 0, $deposit->month, 1));
            $labels[] = "{$monthName} {$deposit->year}";
            $depositCounts[] = $deposit->count;
        }


       

        
        return view('pages.dashboard', compact('availableFunds', 'totalSaccoMembers', 'totalLoanRequests', 'deposits', 'complaints', 'depositDataForGraph', 'labels', 'depositCounts'));
    }


     public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

           // return redirect()->intended('admin');
           return view('pages.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials please use registered email and password.',
        ]);
    }


    
}














use PDF;

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

        //data for the graph
        $depositDataForGraph = SaccoDeposit::select('dateDeposited', 'amount')->get();
        $LoanRepaymemntDataForGraph = SaccoActiveLoan::select('Amount_to_pay', 'Cleared_Amount')->get();

        // Render the pdf_content view into a variable
        $pdfContent = view('pages.pdf_content', compact('depositDataForGraph', 'LoanRepaymemntDataForGraph'))->render();

        // Create an instance of the PDF class
        $pdf = app('dompdf.wrapper'); // Or use PDF::class if it's registered as an alias

        // Load the view into the PDF instance
        $pdf->loadView('pdf.report', $data);

        // Append the pdf_content to the PDF instance
        $pdf->getDomPDF()->getCanvas()->page_script(function($pageNumber, $canvas) use ($pdfContent) {
            $canvas->text(72, 720, $pdfContent);
        });

        // Save the PDF to a temporary file
        $pdfPath = storage_path('app/temp/report.pdf');
        $pdf->save($pdfPath);

        // Send the email with the attached report
        $recipientEmail = 'sayrunjogi@gmail.com'; // Replace with the recipient's email address
        Mail::to($recipientEmail)->send(new HelloMail($pdfPath)); // Send the email

        return "PDF generated and email sent successfully!";
    }
}
