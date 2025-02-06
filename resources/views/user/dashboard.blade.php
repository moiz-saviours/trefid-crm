@extends('user.layouts.app')
@section('title','Dashboard')
@section('content')
    <style>
        .btn-minimize {
            background-color: #ff5722;
            color: #fff;
            font-size: 12px;
        }
        .btn-minimize:hover {
            background-color: #ff5722;
            color: #fff;
        }
        .clos_btn {
            background-color:#2d3e50;
            color: #fff;
            font-size: 12px;
        }
        .clos_btn:hover {
            background-color:#2d3e50;
            color: #fff;
        }
        .right_col {
            display: block;
        }
        .right_col .card {
            margin: 20px 0px;
        }
        .dashbord_tbl {
            border-collapse: collapse;
            width: 100%;
        }
        .tabl_th {
            background-color: #2d3e50;
            text-align: center;
            padding: 15px 0px;
            color: #fff;
        }
        .tabl_td, .tabl_th {
            text-align: left;
            padding: 15px 0px;
            text-align:center;
        }
        .tabl_tr:nth-child(odd) {
            background-color: #98a3b0;
            color: #fff;
        }
        .tabl_tr:nth-child(even) {
            background-color: #fff;
            color: #000 !important;
        }
    </style>
    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <!-- Page title and information -->
                <h1 class="page-title mb-2">Dashboard</h1>
                <h2 class="h5">Welcome to the CRM Dashboard.</h2>
                <!-- END : Page title and information -->
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="row">

                    <!-- Total Sales -->
                    <div class="col-md-3">
                        <div class="card text-white" style="background-color: var(--bs-primary);">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="demo-pli-cart-coin display-6"></i>
                                    <div class="ms-4">
                                        <h5 class="text-white h2 mb-0">${{ $totalSalesAmount }}</h5>
                                        <p class="text-white text-opacity-75 mb-0">Total Sales</p>
                                    </div>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $targetAchieved }}%;"
                                         aria-valuenow="{{ $targetAchieved }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <small>{{ round($targetAchieved, 2) }}% Active</small>
                            </div>
                        </div>
                    </div>

                    <!-- Target -->
                    <div class="col-md-3">
                        <div class="card text-white" style="background-color: var(--bs-primary);">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="demo-pli-cart-coin display-6"></i>
                                    <div class="ms-4">
                                        <h5 class="text-white h2 mb-0">${{ $userTarget }}</h5>
                                        <p class="text-white text-opacity-75 mb-0">Target</p>
                                    </div>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $targetAchieved }}%;"
                                         aria-valuenow="{{ $targetAchieved }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <small>{{ round($targetAchieved, 2) }}% Active</small>
                            </div>
                        </div>
                    </div>

                    <!-- Fresh Invoices -->
                    <div class="col-md-3">
                        <div class="card text-white" style="background-color: var(--bs-primary);">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="demo-pli-cart-coin display-6"></i>
                                    <div class="ms-4">
                                        <h5 class="text-white h2 mb-0">${{ $freshInvoices }}</h5>
                                        <p class="text-white text-opacity-75 mb-0">Fresh Sales</p>
                                    </div>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $freshInvoiceProgress }}%;"
                                         aria-valuenow="{{ $freshInvoiceProgress }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <small>{{ round($freshInvoiceProgress, 2) }}% of Fresh Invoices</small>
                            </div>
                        </div>
                    </div>

                    <!-- Upsale Invoices -->
                    <div class="col-md-3">
                        <div class="card text-white" style="background-color: var(--bs-primary);">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="demo-pli-cart-coin display-6"></i>
                                    <div class="ms-4">
                                        <h5 class="text-white h2 mb-0">${{ $upsaleInvoices }}</h5>
                                        <p class="text-white text-opacity-75 mb-0">UpSales</p>
                                    </div>
                                </div>
                                <div class="progress progress-md">
                                    <div class="progress-bar bg-white" role="progressbar"
                                         style="width: {{ $upsaleInvoiceProgress }}%;"
                                         aria-valuenow="{{ $upsaleInvoiceProgress }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <small>{{ round($upsaleInvoiceProgress, 2) }}% of Upsale Invoices</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="row">
                    <h1 class="page-title mb-2">Invoices</h1>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Paid</h5>
                                <div class="d-flex flex-column gap-3">
                                    <div class="progress progress-lg">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">50</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Due</h5>
                                <div class="d-flex flex-column gap-3">
                                    <div class="progress progress-lg">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">10</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Refund</h5>
                                <div class="d-flex flex-column gap-3">
                                    <div class="progress progress-lg">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">5</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Chargeback</h5>
                                <div class="d-flex flex-column gap-3">
                                    <div class="progress progress-lg">
                                        <div class="progress-bar " role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">6</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header toolbar">
                                <div class="toolbar-start">
                                    <h5 class="m-0">First Chart</h5>
                                </div>
                                <div class="toolbar-end">
                                    <button type="button" class="btn btn-icon btn-minimize btn-xs" data-bs-toggle="collapse" data-bs-target="#_dm-Barchart" aria-expanded="true" aria-controls="_dm-Barchart">
                                        <i class="demo-psi-min"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-xs btn-secondary clos_btn" data-nf-toggler="dismiss" data-nf-target=".card">
                                        <i class="demo-psi-cross"></i>
                                        <span class="visually-hidden">Close the card</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="barchart collapse show" id="_dm-Barchart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header toolbar">
                                <div class="toolbar-start">
                                    <h5 class="m-0">Second Chart</h5>
                                </div>
                                <div class="toolbar-end">
                                    <button type="button" class="btn btn-icon btn-minimize btn-xs" data-bs-toggle="collapse" data-bs-target="#_dm-AreaChart" aria-expanded="true" aria-controls="_dm-AreaChart">
                                        <i class="demo-psi-min"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-xs btn-secondary clos_btn" data-nf-toggler="dismiss" data-nf-target=".card">
                                        <i class="demo-psi-cross"></i>
                                        <span class="visually-hidden">Close the card</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="areachart collapse show" id="_dm-AreaChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Recent Payments</h2>

                        <table class="dashbord_tbl">
                            <tr class="tabl_tr">
                                <th class="tabl_th">Serial No</th>
                                <th class="tabl_th">Invoice No</th>
                                <th class="tabl_th">Payment Method</th>
                                <th class="tabl_th">Brand</th>
                                <th class="tabl_th">Team</th>
                                <th class="tabl_th">Amount</th>
                                <th class="tabl_th">Status</th>
                            </tr>
                            <tr class="tabl_tr">
                                <td class="tabl_td">1</td>
                                <td class="tabl_td">INV-000007</td>
                                <td class="tabl_td">Paypal</td>
                                <td class="tabl_td">Pivot Book Writing</td>
                                <td class="tabl_td">Team 1</td>
                                <td class="tabl_td">1500 USD</td>
                                <td class="tabl_td">Paid</td>
                            </tr>
                            <tr class="tabl_tr">
                                <td class="tabl_td">2</td>
                                <td class="tabl_td">INV-000009</td>
                                <td class="tabl_td">Stripe</td>
                                <td class="tabl_td">Visionary Book Writing</td>
                                <td class="tabl_td">Team 3</td>
                                <td class="tabl_td">500 USD</td>
                                <td class="tabl_td">Paid</td>
                            </tr>
                            <tr class="tabl_tr">
                                <td class="tabl_td">3</td>
                                <td class="tabl_td">INV-000012</td>
                                <td class="tabl_td">Authorize</td>
                                <td class="tabl_td">The Writers Tree</td>
                                <td class="tabl_td">Team 1</td>
                                <td class="tabl_td">2500 USD</td>
                                <td class="tabl_td">Partially Paid</td>
                            </tr>
                            <tr class="tabl_tr">
                                <td class="tabl_td">4</td>
                                <td class="tabl_td">INV-000016</td>
                                <td class="tabl_td">Stripe</td>
                                <td class="tabl_td">The Writers Tree</td>
                                <td class="tabl_td">Team 1</td>
                                <td class="tabl_td">2500 USD</td>
                                <td class="tabl_td">Paid</td>
                            </tr>
                            <tr class="tabl_tr">
                                <td class="tabl_td">5</td>
                                <td class="tabl_td">INV-000017</td>
                                <td class="tabl_td">Paypal</td>
                                <td class="tabl_td">The Writers Tree</td>
                                <td class="tabl_td">Team 1</td>
                                <td class="tabl_td">2500 USD</td>
                                <td class="tabl_td">Paid</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 right_col">
                        <div class="card">
                            <div class="card-header toolbar">
                                <div class="toolbar-start">
                                    <h5 class="m-0">Third Chart</h5>
                                </div>
                                <div class="toolbar-end">
                                    <button type="button" class="btn btn-icon btn-minimize btn-xs" data-bs-toggle="collapse" data-bs-target="#_dm-PieChart" aria-expanded="true" aria-controls="_dm-PieChart">
                                        <i class="demo-psi-min"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-xs btn-secondary clos_btn" data-nf-toggler="dismiss" data-nf-target=".card">
                                        <i class="demo-psi-cross"></i>
                                        <span class="visually-hidden">Close the card</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="pieChart collapse show" id="_dm-PieChart"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header toolbar">
                                <div class="toolbar-start">
                                    <h5 class="m-0">Fourth Chart</h5>
                                </div>
                                <div class="toolbar-end">
                                    <button type="button" class="btn btn-icon btn-minimize btn-xs" data-bs-toggle="collapse" data-bs-target="#_dm-DonutChart" aria-expanded="true" aria-controls="_dm-DonutChart">
                                        <i class="demo-psi-min"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-xs btn-secondary clos_btn" data-nf-toggler="dismiss" data-nf-target=".card">
                                        <i class="demo-psi-cross"></i>
                                        <span class="visually-hidden">Close the card</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="donutchart" id="_dm-DonutChart"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header toolbar">
                                <div class="toolbar-start">
                                    <h5 class="m-0">Fifth Chart</h5>
                                </div>
                                <div class="toolbar-end">
                                    <button type="button" class="btn btn-icon btn-minimize btn-xs" data-bs-toggle="collapse" data-bs-target="#_dm-RadialChart" aria-expanded="true" aria-controls="_dm-RadialChart">
                                        <i class="demo-psi-min"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-xs btn-secondary clos_btn" data-nf-toggler="dismiss" data-nf-target=".card">
                                        <i class="demo-psi-cross"></i>
                                        <span class="visually-hidden">Close the card</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="radialchart" id="_dm-RadialChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    @push('script')
        <script>

            // Bar Chart
            var options = {
                series: [{
                    name: 'Team A',
                    type: 'column',
                    data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                }, {
                    name: 'Team B',
                    type: 'column',
                    data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
                },{
                    name: 'Team C',
                    type: 'column',
                    data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
                },],
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false
                },
                colors: ['#2d3e50', '#ff5722','#98a3b0'], // Custom colors for series
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 1]
                },

                xaxis: {
                    categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016],
                },

                tooltip: {
                    fixed: {
                        enabled: true,
                        position: 'topLeft',
                        offsetY: 30,
                        offsetX: 60
                    },
                },

            };

            var barchart = new ApexCharts($(".barchart")[0], options);
            barchart.render();
            // Bar Chart

            // Area Chart
            var options = {
                series: [{
                    name: 'TEAM A',
                    type: 'area',
                    data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33,60]
                }, {
                    name: 'TEAM B',
                    type: 'line',
                    data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43,60]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                },
                stroke: {
                    curve: 'smooth'
                },
                fill: {
                    type:'solid',
                    opacity: [0.35, 1],
                },

                colors: ['#2d3e50', '#ff5722'],
                labels: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],

                tooltip: {
                    shared: true,
                    intersect: false,

                }
            };

            var areachart = new ApexCharts($(".areachart")[0], options);
            areachart.render();
            // Area Chart

            //Pie Chart
            var options = {
                series: [44, 55, 60],
                chart: {
                    type: 'pie',
                    toolbar: {
                        show: true,
                    },
                },
                colors: ['#2d3e50', '#ff5722','#98a3b0'],
                labels: ['Team A', 'Team B', 'Team C'],
                legend: {
                    position: 'right',
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var pieChart = new ApexCharts($(".pieChart")[0], options);
            pieChart.render();
            //Pie Chart

            //Donut Chart
            var options = {
                series: [44, 55, 60],
                chart: {
                    type: 'donut',
                    toolbar: {
                        show: true,
                    },
                },

                colors: ['#2d3e50', '#ff5722','#98a3b0'],
                labels: ['Team A', 'Team B', 'Team C'],

                legend: {
                    position: 'right',
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var donutchart = new ApexCharts($(".donutchart")[0], options);
            donutchart.render();
            //Donut Chart

            //Radial Chart
            var options = {
                series: [50, 55, 75], // Restricting to 3 values
                chart: {

                    type: 'radialBar',
                    toolbar: {
                        show: true, // Toolbar enabled for download
                        tools: {
                            download: true // Allow chart download
                        }
                    },
                },
                colors: ['#2d3e50', '#ff5722','#98a3b0'], // Custom colors
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '30%',
                        },
                        track: {
                            strokeWidth: '50%',
                        },
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                            },
                            value: {
                                fontSize: '16px',
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: function (w) {
                                    return 166; // Total of 3 series values
                                }
                            }
                        }
                    }
                },
                labels: ['Apples', 'Oranges', 'Bananas'], // Only 3 labels

            };
            var radialchart = new ApexCharts($(".radialchart")[0], options);
            radialchart.render();
            //Radial Chart

        </script>
    @endpush
@endsection
