@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Sacco Deposits OverView'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
           
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Sacco Deposits Table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <h6>

                            <div class="modal-body">
                                <form action="{{ route('CSVdepositsupload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control d-none" id="csv_file_input" name="upload-file" accept=".csv">
                                        <button type="button" class="btn btn-success" id="choose_csv_button">Choose CSV File</button>
                                        <button type="submit" class="btn btn-success d-none" id="upload_csv_button">Upload CSV</button>
                                    </div>
                                </form>
                            </div>
                            

                        </h6>
                        
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">User ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Amount</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Date Deposited</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Receipt Number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deposits as $d)
                                <tr>
                                    <td class="text-center">{{$d->userId}}</td>
                                    <td class="text-center">{{$d->Username}}</td>
                                    <td class="text-center">{{$d->amount}}</td>
                                    <td class="text-center">{{$d->dateDeposited}}</td>
                                    <td class="text-center">{{$d->receiptNumber}}</td>
                                    <td class="text-center">
                                        @if($d->used == 1)
                                                Processed
                                            @else
                                                Pending
                                        @endif
                                    </td>
                                    {{-- <td> <a href="" class="btn btn-info">Edit</a></td> --}}
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
    <script>
        document.getElementById("choose_csv_button").addEventListener("click", function() {
            document.getElementById("csv_file_input").click();
        });

        document.getElementById("csv_file_input").addEventListener("change", function() {
            const fileName = this.value.split("\\").pop();
            if (fileName) {
                document.getElementById("upload_csv_button").classList.remove("d-none");
                document.getElementById("choose_csv_button").classList.add("d-none");
            }
        });
    </script>
    
@endsection



            