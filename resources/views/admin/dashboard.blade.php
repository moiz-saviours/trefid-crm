@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <!-- Page title and information -->
                <h1 class="page-title mb-2">Dashboard</h1>
                <h2 class="h5">Welcome back to the Dashboard.</h2>
                <p>Scroll down to see quick links and overviews of your Server, To do list<br> Order status or get some
                    Help using Nifty.</p>
                <!-- END : Page title and information -->
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="row">
                   <div class="col-md-3">
                       <div class="card text-white mb-3 mb-xl-3" style="background-color: #2d3e50;">
                           <div class="card-body py-3">
                               <div class="d-flex align-items-center mb-3">
                                   <div class="flex-shrink-0">
                                       <i class="d-flex align-items-center justify-content-center demo-pli-add-user-star display-6"></i>
                                   </div>
                                   <div class="flex-grow-1 ms-4">
                                       <h5 class=" text-white h2 mb-0">314,675</h5>
                                       <p class="text-white text-opacity-75 mb-0">Visit Today</p>
                                   </div>
                               </div>

                               <div class="progress progress-md mb-2">
                                   <div class="progress-bar bg-white" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                               </div>

                           </div>
                       </div>
                   </div>
                    <div class="col-md-3">
                        <div class="card text-white mb-3 mb-xl-3" style="background-color: #ff5722">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="d-flex align-items-center justify-content-center demo-pli-male-female display-6"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-4">
                                        <h5 class="text-white h2 mb-0">314,675</h5>
                                        <p class="text-white text-opacity-75 mb-0">Total Customers</p>
                                    </div>
                                </div>

                                <div class="progress progress-md mb-2">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-indigo text-white mb-3 mb-xl-3">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="d-flex align-items-center justify-content-center demo-pli-folder-zip display-6"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-4">
                                        <h5 class="h2 mb-0">314,675</h5>
                                        <p class="text-white text-opacity-75 mb-0">Total Projects</p>
                                    </div>
                                </div>

                                <div class="progress progress-md mb-2">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white mb-3 mb-xl-3">
                            <div class="card-body py-3">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-shrink-0">
                                        <i class="d-flex align-items-center justify-content-center demo-pli-file-pictures display-6"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-4">
                                        <h5 class="h2 mb-0">314,675</h5>
                                        <p class="text-white text-opacity-75 mb-0">Total Tasks</p>
                                    </div>
                                </div>

                                <div class="progress progress-md mb-2">
                                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <h5 class="card-title">Un Paid</h5>
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
                                <h5 class="card-title">Partially Paid</h5>
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
                                <h5 class="card-title">Over Due</h5>
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
                            <div class="card-body">
                                <div class="barchart" id="barchart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="areachart" id="areachart"></div>
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
                            <div class="card-body">
                                <div class="piechart" id="piechart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="donutchart" id="donutchart"></div>
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
                            <div class="card-body">
                                <div class="radialchart" id="radialchart"></div>
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
                title: {
                    text: ' Title',
                    align: 'left',
                    offsetX: 110
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

            var barchart = new ApexCharts(document.querySelector("#barchart"), options);
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
                title: {
                    text: ' Title',
                    align: 'left',
                    offsetX: 110
                },
                colors: ['#2d3e50', '#ff5722'],
                labels: ['Jan', 'Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],

                tooltip: {
                    shared: true,
                    intersect: false,

                }
            };

            var areachart = new ApexCharts(document.querySelector("#areachart"), options);
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
                title: {
                    text: 'Title',
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

            var piechart = new ApexCharts(document.querySelector("#piechart"), options);
            piechart.render();
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
                title :{
                    text: 'Title',
                },
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

            var donutchart = new ApexCharts(document.querySelector("#donutchart"), options);
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
                title: {
                    text: 'Title',
                }
            };
            var radialchart = new ApexCharts(document.querySelector("#radialchart"), options);
            radialchart.render();
            //Radial Chart

        </script>
    @endpush
@endsection
