@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard overview'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Sacco Funds</p>
                                    <h5 class="font-weight-bolder">
                                        {{-- $53,000 --}}
                                        {{-- Format the availableFunds variable if needed --}}
                                        UGX&nbsp;{{ number_format($availableFunds, 2) }}
                                    </h5>
                                    {{-- <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+55%</span>
                                        since yesterday
                                    </p> --}}
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Sacco Members</p>
                                    <h5 class="font-weight-bolder">
                                        {{-- 2,300 --}}
                                        {{$totalSaccoMembers}}
                                    </h5>
                                    {{-- <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+3%</span>
                                        since last week
                                    </p> --}}
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Loan Requests</p>
                                    <h5 class="font-weight-bolder">
                                        {{-- +3,462 --}}
                                        {{$totalLoanRequests}}

                                    </h5>
                                    {{-- <p class="mb-0">
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                        since last quarter
                                    </p> --}}
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Succesful Deposits</p>
                                    <h5 class="font-weight-bolder">
                                        {{-- $103,430 --}}
                                        {{$deposits}}

                                    </h5>
                                    {{-- <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                                    </p> --}}
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="row mt-4">
            {{-- <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Sacco Deposits overview</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="deposit-chart" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active" style="background-image: url('./img/carousel-1.jpg');
                                background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Uprise Sacco</h5>
                                    <p>Smart Savings Brigther Future.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-2.jpg');
                                background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Faster way to Achive your Dreamlife</h5>
                                    <p>Helping individuals achive their dreamlife.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-3.jpg');
                                background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Get a quick loan .</h5>
                                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>




                            <div class="col-lg-7 mb-lg-0 mb-4">
                                <div class="card z-index-2 h-100">
                                    <div class="card-header pb-0 pt-3 bg-transparent">
                                        <h6 class="text-capitalize">Sacco Deposits per Given Date Overview</h6>
                                        {{-- <p class="text-sm mb-0">
                                            <i class="fa fa-arrow-up text-success"></i>
                                            <span class="font-weight-bold">4% more</span> in 2021
                                        </p> --}}
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="chart">
                                            <canvas id="deposit-chart" class="chart-canvas" height="300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        



                            
                        


                                <div class="col-lg-7 mb-lg-0 mb-4">
                                    <div class="card z-index-2 h-100">
                                        <div class="card-header pb-0 pt-3 bg-transparent">
                                            <h6 class="text-capitalize">Sacco Deposits per given Date overview</h6>
                                            {{-- <p class="text-sm mb-0">
                                                <i class="fa fa-arrow-up text-success"></i>
                                                <span class="font-weight-bold">4% more</span> in 2021
                                            </p> --}}
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="chart">
                                                <canvas id="Deposit-chart" class="chart-canvas" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    @push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("deposit-chart").getContext("2d");

        var depositChartData = @json($depositDataForGraph); // Assuming $depositDataForGraph contains your data

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke.addColorStop(0, 'rgba(251, 99, 64, 0)');
        

        new Chart(ctx, {
            type: "line",
            data: {
                labels: depositChartData.map(entry => entry.dateDeposited),
                datasets: [{
                    label: "Deposit Amount",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke,
                    borderWidth: 3,
                    fill: true,
                    data: depositChartData.map(entry => entry.amount),
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>


    

@endpush


@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("Deposit-chart").getContext("2d");

        var depositChartData = @json($depositDataForGraph); // Use $depositDataForGraph here


        // Sort the data by date in ascending order
        depositChartData.sort((a, b) => new Date(a.dateDeposited) - new Date(b.dateDeposited));

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: depositChartData.map(entry => entry.dateDeposited),
                datasets: [{
                    label: "Deposit Amount",
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    data: depositChartData.map(entry => entry.amount),
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date Deposited'
                        }
                    }
                }
            },
        });
    </script>
@endpush














