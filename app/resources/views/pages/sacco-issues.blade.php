@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Sacco Members\' Complaint\'s Table '])
    <div class="row mt-4 mx-4">
        <div class="col-12">
           
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Clients' Complaints Table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        {{-- <p>
                            <a href="" class="btn btn-primary">Upload CSV</a>
                        </p> --}}
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">MemberNumber</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">phoneNumber
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        dateofrequest</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        referencenumber</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                        Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($issues as $i)
                                <tr>
                                    <td class="text-center">{{$i->MemberNumber}}</td>
                                    <td class="text-center">{{$i->phoneNumber}}</td>
                                    <td class="text-center">{{$i->DateofRequest}}</td>
                                    <td class="text-center">{{$i->ReferenceNumber}}</td>
                                    <td class="text-center"> <a href="" class="btn btn-info">view</a> </td>
                                    
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
    
@endsection



            