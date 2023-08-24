<?php

namespace App\Jobs;




use App\Models\SaccoMember;
use App\Models\SaccoActiveLoan;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DeductLoanPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
   public function handle()
{
    try {
        DB::transaction(function () {
            $membersWithActiveLoans = SaccoMember::whereIn('MemberNumber', function ($query) {
                $query->select('MemberID')
                    ->from('sacco_active_loans');
            })->with('activeLoan')->get();

            foreach ($membersWithActiveLoans as $member) {
                $loan = $member->activeLoan;

            if ($loan) {

                $dailyPayment = $loan->Amount_to_pay / ($loan->Payment_Period * 30);

                Log::info("Calculated Daily Pay: " . $dailyPayment);
                Log::info("Member: {$member->Username}, Loan Balance: {$loan->Loan_Balance}");
                //exit(0);
                
                // Perform the necessary updates within the transaction
                $member->accountBalance -= $dailyPayment;
                $member->save();

                $loan->Cleared_Amount += $dailyPayment;
                $loan->Loan_Balance = $loan->Amount_to_pay - $loan->Cleared_Amount;

                if ($loan->Loan_Balance <= 0) {
                    $loan->status = 'Fully Paid';
                }

                // Save the updates for both the member and the loan
                $loan->save();
            }
        }
        });
    } catch (\Exception $e) {
        Log::error("Error in DeductLoanPayment job: " . $e->getMessage());
    }
}



}
