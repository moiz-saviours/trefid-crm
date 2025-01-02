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
                    <div class="col-md-6">
                        <div class="chart" id="chart"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            var options = {
                series: [{
                    name: 'Income',
                    type: 'column',
                    data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
                }, {
                    name: 'Cashflow',
                    type: 'column',
                    data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
                },],
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false
                },
                colors: ['#2d3e50', '#ff5722'], // Custom colors for series
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 4]
                },
                title: {
                    text: ' Title',
                    align: 'left',
                    offsetX: 110
                },
                xaxis: {
                    categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016],
                },
                yaxis: [
                    {
                        seriesName: 'Income',
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#2d3e50'
                        },
                        labels: {
                            style: {
                                colors: '#2d3e50',
                            }
                        },
                        title: {

                            style: {
                                color: '#2d3e50',
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    {
                        seriesName: 'Cashflow',
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#ff5722'
                        },
                        labels: {
                            style: {
                                colors: '#ff5722',
                            }
                        },

                    },

                ],
                tooltip: {
                    fixed: {
                        enabled: true,
                        position: 'topLeft',
                        offsetY: 30,
                        offsetX: 60
                    },
                },
                legend: {
                    horizontalAlign: 'left',
                    offsetX: 40
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        </script>
    @endpush
@endsection
