@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Search Results'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Search Results</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead class="thead-light">
                                <tr>
                                    @if ($route === 'deposits')
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">User ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Amount</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Date Deposited</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Receipt Number</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                                        <!-- Add more table headers specific to deposits -->
                                    @elseif ($route === 'saccomembers')
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">UserId</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">Username
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">email</th>
                                    {{-- <th
                                        class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                        password</th> --}}
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">phoneNumber</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">MemberNumber</th>
                                    <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">accountBalance</th>
                                    {{-- <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7">Action</th> --}}
                                        <!-- Add more table headers specific to members -->
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($searchResults as $result)
                                    <tr>
                                        @if ($route === 'deposits')
                                        <td class="text-center">{{$result->userId}}</td>
                                        <td class="text-center">{{$result->Username}}</td>
                                        <td class="text-center">{{$result->amount}}</td>
                                        <td class="text-center">{{$result->dateDeposited}}</td>
                                        <td class="text-center">{{$result->receiptNumber}}</td>
                                        <td class="text-center">
                                            @if($result->used == 1)
                                                    Processed
                                                @else
                                                    Pending
                                            @endif
                                        </td>
                                            <!-- Populate more cells specific to deposits -->
                                        @elseif ($route === 'saccomembers')
                                            <td class="text-center">{{$result->UserId}}</td>
                                            <td class="text-center">{{$result->Username}}</td>
                                            <td class="text-center">{{$result->email}}</td>
                                            {{-- <td class="text-center">{{$m->password}}</td> --}}
                                            <td class="text-center">{{$result->phoneNumber}}</td>
                                            <td class="text-center">{{$result->MemberNumber}}</td>
                                            <td class="text-center">{{$result->accountBalance}}</td>
                                            {{-- <td> <a href="" class="btn btn-info">Edit</a></td> --}}
                                                    <!-- Populate more cells specific to members -->
                                                @endif
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
