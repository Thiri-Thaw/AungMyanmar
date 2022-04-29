@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="row">
    <div class="col-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$sale_details->sum('quantity')}}</h3>

                <p>Today Sale</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('sale.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$purchase_items->sum('quantity')}}<sup style="font-size: 20px"></sup></h3>

                <p>Today Purchase</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('purchase.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    {{-- <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>

                </h3>

                <p>Today Income</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Today Inventory</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col --> --}}
</div>
<div class="row  d-flex justify-content-center">

    {{-- <div class="col-md-4">
        <div class="card bg-gradient-success p-3" style="position: relative; left: 10px; top: 40px;">
            <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
                            data-offset="-52">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="#" class="dropdown-item">Add new event</a>
                            <a href="#" class="dropdown-item">Clear events</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">View calendar</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <!--The calendar -->
            <div id="calendar" style="width: 100%" class="text-center ">
                <div class="bootstrap-datetimepicker-widget usetwentyfour">
                    <ul class="list-unstyled">
                        <li class="show">
                            <div class="datepicker">
                                <div class="datepicker-days">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th class="prev" data-action="previous"><span class="fa fa-chevron-left"
                                                        title="Previous Month"></span></th>
                                                <th class="picker-switch" data-action="pickerSwitch" colspan="5"
                                                    title="Select Month">March 2022</th>
                                                <th class="next" data-action="next"><span class="fa fa-chevron-right"
                                                        title="Next Month"></span></th>
                                            </tr>
                                            <tr>
                                                <th class="dow">Su</th>
                                                <th class="dow">Mo</th>
                                                <th class="dow">Tu</th>
                                                <th class="dow">We</th>
                                                <th class="dow">Th</th>
                                                <th class="dow">Fr</th>
                                                <th class="dow">Sa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td data-action="selectDay" data-day="02/27/2022" class="day old weekend">27
                                                </td>
                                                <td data-action="selectDay" data-day="02/28/2022" class="day old">28</td>
                                                <td data-action="selectDay" data-day="03/01/2022" class="day">1</td>
                                                <td data-action="selectDay" data-day="03/02/2022" class="day">2</td>
                                                <td data-action="selectDay" data-day="03/03/2022" class="day">3</td>
                                                <td data-action="selectDay" data-day="03/04/2022" class="day active today">4
                                                </td>
                                                <td data-action="selectDay" data-day="03/05/2022" class="day weekend">5</td>
                                            </tr>
                                            <tr>
                                                <td data-action="selectDay" data-day="03/06/2022" class="day weekend">6</td>
                                                <td data-action="selectDay" data-day="03/07/2022" class="day">7</td>
                                                <td data-action="selectDay" data-day="03/08/2022" class="day">8</td>
                                                <td data-action="selectDay" data-day="03/09/2022" class="day">9</td>
                                                <td data-action="selectDay" data-day="03/10/2022" class="day">10</td>
                                                <td data-action="selectDay" data-day="03/11/2022" class="day">11</td>
                                                <td data-action="selectDay" data-day="03/12/2022" class="day weekend">12
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-action="selectDay" data-day="03/13/2022" class="day weekend">13
                                                </td>
                                                <td data-action="selectDay" data-day="03/14/2022" class="day">14</td>
                                                <td data-action="selectDay" data-day="03/15/2022" class="day">15</td>
                                                <td data-action="selectDay" data-day="03/16/2022" class="day">16</td>
                                                <td data-action="selectDay" data-day="03/17/2022" class="day">17</td>
                                                <td data-action="selectDay" data-day="03/18/2022" class="day">18</td>
                                                <td data-action="selectDay" data-day="03/19/2022" class="day weekend">19
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-action="selectDay" data-day="03/20/2022" class="day weekend">20
                                                </td>
                                                <td data-action="selectDay" data-day="03/21/2022" class="day">21</td>
                                                <td data-action="selectDay" data-day="03/22/2022" class="day">22</td>
                                                <td data-action="selectDay" data-day="03/23/2022" class="day">23</td>
                                                <td data-action="selectDay" data-day="03/24/2022" class="day">24</td>
                                                <td data-action="selectDay" data-day="03/25/2022" class="day">25</td>
                                                <td data-action="selectDay" data-day="03/26/2022" class="day weekend">26
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-action="selectDay" data-day="03/27/2022" class="day weekend">27
                                                </td>
                                                <td data-action="selectDay" data-day="03/28/2022" class="day">28</td>
                                                <td data-action="selectDay" data-day="03/29/2022" class="day">29</td>
                                                <td data-action="selectDay" data-day="03/30/2022" class="day">30</td>
                                                <td data-action="selectDay" data-day="03/31/2022" class="day">31</td>
                                                <td data-action="selectDay" data-day="04/01/2022" class="day new">1</td>
                                                <td data-action="selectDay" data-day="04/02/2022" class="day new weekend">2
                                                </td>
                                            </tr>
                                            <tr>
                                                <td data-action="selectDay" data-day="04/03/2022" class="day new weekend">3
                                                </td>
                                                <td data-action="selectDay" data-day="04/04/2022" class="day new">4</td>
                                                <td data-action="selectDay" data-day="04/05/2022" class="day new">5</td>
                                                <td data-action="selectDay" data-day="04/06/2022" class="day new">6</td>
                                                <td data-action="selectDay" data-day="04/07/2022" class="day new">7</td>
                                                <td data-action="selectDay" data-day="04/08/2022" class="day new">8</td>
                                                <td data-action="selectDay" data-day="04/09/2022" class="day new weekend">9
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="datepicker-months" style="display: none;">
                                    <table class="table-condensed">
                                        <thead>
                                            <tr>
                                                <th class="prev" data-action="previous"><span class="fa fa-chevron-left"
                                                        title="Previous Year"></span></th>
                                                <th class="picker-switch" data-action="pickerSwitch" colspan="5"
                                                    title="Select Year">2022</th>
                                                <th class="next" data-action="next"><span class="fa fa-chevron-right"
                                                        title="Next Year"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span
                                                        data-action="selectMonth" class="month">Feb</span><span
                                                        data-action="selectMonth" class="month active">Mar</span><span
                                                        data-action="selectMonth" class="month">Apr</span><span
                                                        data-action="selectMonth" class="month">May</span><span
                                                        data-action="selectMonth" class="month">Jun</span><span
                                                        data-action="selectMonth" class="month">Jul</span><span
                                                        data-action="selectMonth" class="month">Aug</span><span
                                                        data-action="selectMonth" class="month">Sep</span><span
                                                        data-action="selectMonth" class="month">Oct</span><span
                                                        data-action="selectMonth" class="month">Nov</span><span
                                                        data-action="selectMonth" class="month">Dec</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="datepicker-years" style="display: none;">
                                    <table class="table-condensed">
                                        <thead>
                                            <tr>
                                                <th class="prev" data-action="previous"><span class="fa fa-chevron-left"
                                                        title="Previous Decade"></span></th>
                                                <th class="picker-switch" data-action="pickerSwitch" colspan="5"
                                                    title="Select Decade">2020-2029</th>
                                                <th class="next" data-action="next"><span class="fa fa-chevron-right"
                                                        title="Next Decade"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7"><span data-action="selectYear" class="year old">2019</span><span
                                                        data-action="selectYear" class="year">2020</span><span
                                                        data-action="selectYear" class="year">2021</span><span
                                                        data-action="selectYear" class="year active">2022</span><span
                                                        data-action="selectYear" class="year">2023</span><span
                                                        data-action="selectYear" class="year">2024</span><span
                                                        data-action="selectYear" class="year">2025</span><span
                                                        data-action="selectYear" class="year">2026</span><span
                                                        data-action="selectYear" class="year">2027</span><span
                                                        data-action="selectYear" class="year">2028</span><span
                                                        data-action="selectYear" class="year">2029</span><span
                                                        data-action="selectYear" class="year old">2030</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="datepicker-decades" style="display: none;">
                                    <table class="table-condensed">
                                        <thead>
                                            <tr>
                                                <th class="prev" data-action="previous"><span class="fa fa-chevron-left"
                                                        title="Previous Century"></span></th>
                                                <th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090
                                                </th>
                                                <th class="next" data-action="next"><span class="fa fa-chevron-right"
                                                        title="Next Century"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7"><span data-action="selectDecade" class="decade old"
                                                        data-selection="2006">1990</span><span data-action="selectDecade"
                                                        class="decade" data-selection="2006">2000</span><span
                                                        data-action="selectDecade" class="decade"
                                                        data-selection="2016">2010</span><span data-action="selectDecade"
                                                        class="decade active" data-selection="2026">2020</span><span
                                                        data-action="selectDecade" class="decade"
                                                        data-selection="2036">2030</span><span data-action="selectDecade"
                                                        class="decade" data-selection="2046">2040</span><span
                                                        data-action="selectDecade" class="decade"
                                                        data-selection="2056">2050</span><span data-action="selectDecade"
                                                        class="decade" data-selection="2066">2060</span><span
                                                        data-action="selectDecade" class="decade"
                                                        data-selection="2076">2070</span><span data-action="selectDecade"
                                                        class="decade" data-selection="2086">2080</span><span
                                                        data-action="selectDecade" class="decade"
                                                        data-selection="2096">2090</span><span data-action="selectDecade"
                                                        class="decade old" data-selection="2106">2100</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                        <li class="picker-switch accordion-toggle"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-md-10">
        <!-- /.card-header -->
        <div class="card-body">

            <div class="title">Daily Report chart</div>
            <div class="card chart-container">
                <canvas id="chart"></canvas>
            </div>

        </div>
    </div>
    <!-- /.card-body -->
    </div>

    <!-- /.card-body -->
</div>
        <!-- /.content -->

</div>

@endsection
@section('script')
<script>
    const ctx = document.getElementById("chart").getContext('2d');
    var p_item = "{{$purchase_items->sum('quantity')}}";
    var s_item = "{{$sale_details->sum('quantity')}}";
    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
        labels: ["purchase", "sale"],
        datasets: [{
            label: 'food Items',
            data: [p_item, s_item],
            backgroundColor: [
                "#28a745", "#17a2b8"
            ]
        }]
        },
    });
</script>
@endsection
