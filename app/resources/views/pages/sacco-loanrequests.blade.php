@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Sacco Deposits OverView'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
           
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Sacco Loan Requests Table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        {{-- <p>
                             <div class="modal-body">
                                
                                <a href="" class="btn btn-success">Upload CSV</a>
                            </div>
                        </p> --}}
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">amountRequesting</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" >paymentperiod</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">LoanApplicationNumber</th>
                                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center"> LoanStatus</th>
                                     <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($loanrequests as $l)
                                <tr>
                                    <td class="text-center">{{$l->username}}</td>
                                    <td class="text-center">{{$l->amountrequesting}}</td>
                                    <td class="text-center">{{$l->paymentperiod}}</td>
                                    <td class="text-center">{{$l->LoanAppNumber}}</td>
                                    <td class="text-center">{{$l->LoanStatus}}</td>
                                    <td class="text-center"> 
                                        @if($l->LoanStatus === 'Active')
                                            <button class="btn btn-success" disabled>Activated</button>
                                            @elseif($l->LoanStatus === 'Pending')
                                            <button class="btn btn-dark" disabled>Waiting to process</button>
                                            @else
                                             <button class="btn btn-danger activate-button" data-loan-id="{{ $l->id }}">Activate</button>
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


<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     const activateButtons = document.querySelectorAll('.activate-button');

    //     activateButtons.forEach(button => {
    //         button.addEventListener('click', function() {
    //             const loanId = this.getAttribute('data-loan-id');

    //             // Make an AJAX request to update the LoanStatus
    //             fetch(`/update-loan-status/${loanId}`, {
    //                 method: 'PUT', // Assuming you'll use PUT method
    //                 headers: {
    //                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //                     'Content-Type': 'application/json'
    //                 },
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.success) {
    //                     // Update the button and UI as needed
    //                     this.classList.remove('btn-danger');
    //                     this.classList.add('btn-success');
    //                     this.textContent = 'Active';
    //                     this.disabled = true;
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error('Error:', error);
    //             });
    //         });
    //     });
    // });


    document.addEventListener('DOMContentLoaded', function() {
    const activateButtons = document.querySelectorAll('.activate-button');

    activateButtons.forEach(button => {
        button.addEventListener('click', function() {
            const loanId = this.getAttribute('data-loan-id');

            // Make an AJAX request to update the LoanStatus
            fetch(`/update-loan-status/${loanId}`, {
                method: 'PUT', // Assuming you'll use PUT method
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the button style and label
                    this.classList.remove('btn-danger');
                    this.classList.add('btn-success');
                    this.textContent = 'Active';
                    this.disabled = true;
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});

</script>

            