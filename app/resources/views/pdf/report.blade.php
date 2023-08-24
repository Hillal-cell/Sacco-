<!DOCTYPE html>
<html>
<head>
    <title>PDF Report</title>
    <style>
   
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, h2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Sacco Report</h1>

    <h2>Sacco Deposits</h2>
    <table >
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Amount</th>
                <th>Date Deposited</th>
                <th>Receipt Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saccoDeposits as $deposit)
                <tr>
                    <td>{{ $deposit->userId }}</td>
                    <td>{{ $deposit->Username }}</td>
                    <td>{{ $deposit->amount }}</td>
                    <td>{{ $deposit->dateDeposited }}</td>
                    <td>{{ $deposit->receiptNumber }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Sacco Issues</h2>
    <table >
        <thead>
            <tr>
                <th>ID</th>
                <th>Member Number</th>
                <th>Phone Number</th>
                <th>Date of Request</th>
                <th>Reference Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saccoIssues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->MemberNumber }}</td>
                    <td>{{ $issue->phoneNumber }}</td>
                    <td>{{ $issue->DateofRequest }}</td>
                    <td>{{ $issue->ReferenceNumber }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Sacco Loan Requests</h2>
    <table >
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Amount Requesting</th>
                <th>Payment Period</th>
                <th>Loan App Number</th>
                <th>Loan Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saccoLoanRequests as $loanRequest)
                <tr>
                    <td>{{ $loanRequest->id }}</td>
                    <td>{{ $loanRequest->username }}</td>
                    <td>{{ $loanRequest->amountrequesting }}</td>
                    <td>{{ $loanRequest->paymentperiod }}</td>
                    <td>{{ $loanRequest->LoanAppNumber }}</td>
                    <td>{{ $loanRequest->LoanStatus }}</td>
                    <td>{{ $loanRequest->created_at }}</td>
                    <td>{{ $loanRequest->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Sacco Members</h2>
    <table >
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Member Number</th>
                <th>Account Balance</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saccoMembers as $member)
                <tr>
                    <td>{{ $member->UserId }}</td>
                    <td>{{ $member->Username }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phoneNumber }}</td>
                    <td>{{ $member->MemberNumber }}</td>
                    <td>{{ $member->accountBalance }}</td>
                    <td>{{ $member->created_at }}</td>
                    <td>{{ $member->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Sacco Active Loans</h2>
    <table >
        <thead>
            <tr>
                <th>ID</th>
                <th>Member ID</th>
                <th>Username</th>
                <th>Amount to Pay</th>
                <th>Payment Period</th>
                <th>Cleared Amount</th>
                <th>Loan Balance</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($saccoActiveLoans as $activeLoan)
                <tr>
                    <td>{{ $activeLoan->id }}</td>
                    <td>{{ $activeLoan->MemberID }}</td>
                    <td>{{ $activeLoan->Username }}</td>
                    <td>{{ $activeLoan->Amount_to_pay }}</td>
                    <td>{{ $activeLoan->Payment_Period }}</td>
                    <td>{{ $activeLoan->Cleared_Amount }}</td>
                    <td>{{ $activeLoan->Loan_Balance }}</td>
                    <td>{{ $activeLoan->created_at }}</td>
                    <td>{{ $activeLoan->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        
    
