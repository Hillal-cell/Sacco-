@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Sacco Active Loans OverView'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
           
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Sacco Active Loans Table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">MemberId</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Amount to pay</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Payment Period in (Months)</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">cleared amount</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">loan balance</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th> {{-- New column for status --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loans as $l)
                                <tr>
                                    <td class="text-center">{{$l->MemberID}}</td>
                                    <td class="text-center">{{$l->Username}}</td>
                                    <td class="text-center">{{$l->Amount_to_pay}}</td>
                                    <td class="text-center">{{$l->Payment_Period}}</td>
                                    <td class="text-center">{{$l->Cleared_Amount}}</td>
                                    <td class="text-center">{{$l->Loan_Balance}}</td>
                                    <td class="text-center">
                                        @if($l->Loan_Balance <= 0)
                                            <span class="btn btn-success">Fully Paid</span>
                                        @else
                                            <span class="btn btn-warning">Active</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
