<!DOCTYPE html>
<html>
<head>
    <title>PDF Content</title>
    <!-- Include necessary CSS and JavaScript libraries -->
    <!-- Make sure you include any stylesheets and scripts that your graphs depend on -->
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
</head>
<body>
    <!-- Include the carousel and graph sections -->
    <div class="col-lg-5">
        <!-- Carousel code -->
    </div>




    <div class="col-lg-7 mb-lg-0 mb-4">
        <!-- Deposit chart code -->

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
    </div>





    <div class="col-lg-7 mb-lg-0 mb-4">
        <!-- Loan payments chart code -->


         
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Sacco Loan Payments  overview</h6>
                <p class="text-sm mb-0">
                    <i class="fa fa-arrow-up text-success"></i>
                    <span class="font-weight-bold">4% more</span> in 2021
                </p>
            </div>
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="Loan-chart" class="chart-canvas" height="300"></canvas>
                </div>
            </div>
        </div>
            
    </div>








    <!-- Include other elements and sections as needed -->

    <!-- Include the JavaScript for rendering the graphs -->






    <script>
        // JavaScript code for graph initialization and rendering
        @push('js')
    @push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("deposit-chart").getContext("2d");

       

        var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
        gradientStroke.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke.addColorStop(0, 'rgba(251, 99, 64, 0)');
        

        new Chart(ctx, {
            type: "bar",
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
        var ctx = document.getElementById("Loan-chart").getContext("2d");

        

        new Chart(ctx, {
            type: "bar", // Change the chart type to "bar"
            data: {
                labels: depositChartData.map(entry => entry.Amount_to_pay),
                datasets: [{
                    label: "Deposit Amount",
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color for bars
                    borderColor: 'rgba(75, 192, 192, 1)', // Border color for bars
                    borderWidth: 1,
                    data: depositChartData.map(entry => entry.Cleared_Amount),
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
                        ticks: {
                            display: false, // Hide X-axis labels for bar chart
                        }
                    }
                }
            },
        });
    </script>
@endpush

   


    </script>
</body>
</html>
