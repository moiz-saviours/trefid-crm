@extends('admin.layouts.app')
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
            background-color: #2d3e50;
            color: #fff;
            font-size: 12px;
        }

        .clos_btn:hover {
            background-color: #2d3e50;
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
            text-align: center;
        }

        .tabl_tr:nth-child(odd) {
            background-color: #98a3b0;
            color: #fff;
        }

        .tabl_tr:nth-child(even) {
            background-color: #fff;
            color: #000 !important;
        }

        /*New Dashboard Style*/
        .main-dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /*padding: 12px 10px;*/
            margin-top: -34px;
        }

        .main-dashboard-heading {
            font-size: 16px;
            color: #000;
            /* font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; */
            font-weight: 500;
        }

        .main-date-input {
            border: solid #ccc;
            border-width: 0px 0px 1px;
            background: transparent;
            font-size: 15px;
            min-width: 147px;
        }

        .tabular-main-box {
            padding: 9px 0px;
            /*box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;*/
            background-color: #b6bbc200;
            margin: 12px 0px;
            border-radius: 8px;

        }

        .sales-number-div {
            background-color: #fff;
            /* text-align: center; */
            border-radius: 7px;
            padding: 21px 12px;
            height: 100%;

        }

        .sales-total-heading {
            color: var(--bs-primary);
            font-size: 14px;
        }

        .sales-number-div p {
            margin: 0;
            font-size: 13px;
            color: #000;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 25px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: var(--bs-primary);
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            background: var(--bs-primary);
            cursor: pointer;
        }

        .mtd-hedaing {
            font-size: 15px;
            color: #ccc;
        }

        .Acheived-numbers {
            color: green;
        }

        table th {
            font-size: 13px !important;
            color: #000;

            text-transform: capitalize;
        }

        table td,
        tr {
            font-size: 10px !important;

        }

        .sales-record-table-container {
            height: 388px !important;
            overflow-y: scroll !important;
        }

        .sales-record-table-container::-webkit-scrollbar {
            width: 8px;
            /* width of the entire scrollbar */
        }

        .sales-record-table-container::-webkit-scrollbar-track {
            background: #fff;
            /* color of the tracking area */
        }

        .sales-record-table-container::-webkit-scrollbar-thumb {
            background-color: var(--bs-primary);
            /* color of the scroll thumb */
            /* border-radius: 20px; */
            /* roundness of the scroll thumb */
            /* border: 3px solid orange; */
            /* creates padding around scroll thumb */
        }

        .sales-record-table tbody,
        td,
        tfoot,
        th,
        thead {
            border: none;
        }

        .sales-record-table-row {
            /*box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;*/
            /* box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgb(14 30 37 / 29%) 0px 2px 16px 0px; */
        }

        .sales-record-table {
            /*background-color: #fff;*/
            border: none !important;
            /*border-collapse: separate;*/
            /*border-spacing: 0 10px;*/
            /*padding: 9px 6px;*/
            border-radius: 7px;
        }

        .table-headings {
        }

        .monthly-sales-record-table {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            /*box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;*/
        }

        .monthly-sales-record-table tr:nth-child(even) {
            background-color: #fff !important;
            color: #000 !important;
        }

        .monthly-sales-record-table-row {
            background-color: #fff;
        }

        .progress-bar-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
    </style>
    <section id="content" class="content">
        <div class="content__header content__boxed overlapping">
            <div class="content__wrap">
                <!-- Page title and information -->
                <h1 class="page-title mb-2">Stats Dashboard</h1>
                {{--                <h2 class="h5">Welcome to the Stats Dashboard.</h2>--}}
                <p>Welcome to the Stats Dashboard.</p>
                {{--                <!-- END : Page title and information -->--}}
            </div>
        </div>
        <div class="content__boxed">
            <div class="content__wrap">

                <!-- new dashboard content start -->


                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-dashboard-header">
                                <h2 class="main-dashboard-heading"></h2>
                                <div class="form-group">
                                    <label for="dateRangePicker">Select Date Range:</label>
                                    <input type="text" id="dateRangePicker" name="dateRangePicker"
                                           class="form-control dateRangePicker"/>
                                </div>

                                {{--                                <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01"--}}
                                {{--                                       max="2018-12-31" class="main-date-input"/>--}}

                            </div>
                        </div>

                        <div class="tabular-main-box">
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <div class="sales-number-div text-center">
                                        <h2 class="sales-total-heading">Total Sales</h2>
                                        <p id="total-sales-count" class="total-sales-count"> $256,580 </p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="sales-number-div text-center">
                                        <h2 class="sales-total-heading">Total Cash</h2>
                                        <p class="total-sales-count"> $224,278 </p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="sales-number-div text-center">
                                        <h2 class="sales-total-heading">Refunds / Chargeback</h2>
                                        <p id="refund-charge-back" class="total-sales-count"> $8,041 / $3,248 </p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="sales-number-div text-center">
                                        <h2 class="sales-total-heading">Chargeback Ratio</h2>
                                        <p id="charge-back-ratio" class="total-sales-count"> 1 % </p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="sales-number-div text-center">
                                        <h2 class="sales-total-heading">Reverse sales</h2>
                                        <p class="total-sales-count"> $16,594 </p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="sales-number-div text-center">
                                        <h2 class="sales-total-heading">Net Cash</h2>
                                        <p class="total-sales-count"> $229,583 </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 ">
                                <div class="col-lg-5">
                                    <div class="row ">
                                        <div class="col-lg-6 ">
                                            <div class="sales-number-div">
                                                <h2 class="sales-total-heading">Targeted Vs Acheived</h2>
                                                <p class="total-sales-count"> $234538 </p>
                                                <style>

                                                </style>
                                                <div class="progress-bar-wrapper">
                                                    <div>
                                                        <div class="progress" style="width: 150px;">
                                                            <div class="progress-bar progress-bar-animated bg-primary"
                                                                 role="progressbar" style="width: 40%"
                                                                 aria-valuenow="35"
                                                                 aria-valuemin="0" aria-valuemax="100">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>109%</p>
                                                </div>
                                                <!-- <input type="range" min="1" max="100" value="50"><span>109%</span> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="sales-number-div">
                                                <h2 class="mtd-hedaing">MTD/LA</h2>
                                                <p class="total-sales-count"> $234538 / <span class="Acheived-numbers">
                                                    6.187</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6  mt-3">
                                            <div class="sales-number-div">
                                                <h2 class="mtd-hedaing">UPSELL</h2>
                                                <p class="total-sales-count"> $234538
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-6  mt-3">
                                            <div class="sales-number-div">
                                                <h2 class="mtd-hedaing">Accounts</h2>
                                                <p class="total-sales-count"> $234538
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mt-3">
                                            <style>


                                            </style>
                                            <table class="monthly-sales-record-table table">
                                                <thead>
                                                <tr class="monthly-sales-record-table-row ">
                                                    <th scope="col">Month</th>
                                                    <th scope="col">Target</th>
                                                    <th scope="col">Target Acheived</th>
                                                    <th scope="col">Acheived %</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Mark</td>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <td>Mark</td>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <td>Mark</td>
                                                    <td>Larry the Bird</td>
                                                    <td>Larry the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-lg-7 col-md-12">
{{--                                    <div class="sales-record-table-container">--}}
                                    <div class="sales-record-table-container monthly-sales-record-table">
                                        <table class="table sales-record-table ">
                                            <thead>
                                            <tr class="monthly-sales-record-table-row ">
                                                <th class="table-headings">Name</th>
                                                <th class="table-headings">Target</th>
                                                <th class="table-headings">Sales</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>
                                            <tr class="sales-record-table-row">
                                                <td>TESSSSSSSSSSST</td>
                                                <td>TESSSST</td>
                                                <td>T</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- new dashboard content end -->
            </div>
        </div>


    </section>

    @push('script')
        <script>
            // Bar Chart
            if ($(".barchart").length > 0) {
                var options = {
                    series: [{
                        name: 'Team A',
                        type: 'column',
                        data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                    }, {
                        name: 'Team B',
                        type: 'column',
                        data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
                    }, {
                        name: 'Team C',
                        type: 'column',
                        data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
                    },],
                    chart: {
                        height: 350,
                        type: 'line',
                        stacked: false
                    },
                    colors: ['#2d3e50', '#ff5722', '#98a3b0'], // Custom colors for series
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
            }
            // Bar Chart

            // Area Chart
            if ($(".areachart").length > 0) {
                var options = {
                    series: [{
                        name: 'TEAM A',
                        type: 'area',
                        data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33, 60]
                    }, {
                        name: 'TEAM B',
                        type: 'line',
                        data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43, 60]
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    fill: {
                        type: 'solid',
                        opacity: [0.35, 1],
                    },

                    colors: ['#2d3e50', '#ff5722'],
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

                    tooltip: {
                        shared: true,
                        intersect: false,

                    }
                };
                var areachart = new ApexCharts($(".areachart")[0], options);
                areachart.render();
            }
            // Area Chart

            //Pie Chart
            if ($(".pieChart").length > 0) {
                var options = {
                    series: [44, 55, 60],
                    chart: {
                        type: 'pie',
                        toolbar: {
                            show: true,
                        },
                    },
                    colors: ['#2d3e50', '#ff5722', '#98a3b0'],
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
            }
            //Pie Chart

            //Donut Chart
            if ($(".donutchart").length > 0) {
                var options = {
                    series: [44, 55, 60],
                    chart: {
                        type: 'donut',
                        toolbar: {
                            show: true,
                        },
                    },

                    colors: ['#2d3e50', '#ff5722', '#98a3b0'],
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
            }
            //Donut Chart

            //Radial Chart
            if ($(".radialchart").length > 0) {
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
                    colors: ['#2d3e50', '#ff5722', '#98a3b0'], // Custom colors
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
            }
            //Radial Chart

        </script>

        <!-- Date Range Picker -->
        <script src="{{asset('assets/js/moment.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/daterangepicker/daterangepicker.min.js')}}"></script>
        <script>
            function dateRangePicker(input) {
                input.daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    startDate: moment().startOf('month'), // Default start date (beginning of current month)
                    endDate: moment().endOf('month'), // Default end date (end of current month)
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                });
            }

            $(document).ready(function () {
                // Initialize daterangepicker if element with ID exists
                if ($('#dateRangePicker').length) {
                    dateRangePicker($('#dateRangePicker'));
                }

                // Send date range request to update stats on page load with default range
                let defaultStartDate = moment().startOf('month').format('YYYY-MM-DD');
                let defaultEndDate = moment().endOf('month').format('YYYY-MM-DD');
                sendDatePickerReq(defaultStartDate, defaultEndDate);

                // Listen to 'apply' event and send the selected date range
                $('#dateRangePicker').on('apply.daterangepicker', function (ev, picker) {
                    var startDate = picker.startDate.format('YYYY-MM-DD');
                    var endDate = picker.endDate.format('YYYY-MM-DD');
                    sendDatePickerReq(startDate, endDate);
                });

                // Listen to 'cancel' event and clear the date range
                $('#dateRangePicker').on('cancel.daterangepicker', function () {
                    sendDatePickerReq('', '');
                });
            });

            // Function to send AJAX request with date range
            function sendDatePickerReq(startDate, endDate) {
                let url = `{{ route("admin.dashboard.2.update.stats") }}`;
                if (startDate && endDate) {
                    AjaxRequestPromise(url, {start_date: startDate, end_date: endDate}, 'GET')
                        .then(response => {
                            if (response.success) {
                                // Update the total sales count
                                $("#total-sales-count").text(response.total_sales);
                                $("#refund-charge-back").text(response.refunded + ' / ' + response.charge_back);
                                $("#charge-back-ratio").text(response.charge_back_ratio);
                            }
                        })
                        .catch(error => console.log(error));
                }
            }
        </script>
        <!-- Date Range Picker -->

    @endpush
@endsection
