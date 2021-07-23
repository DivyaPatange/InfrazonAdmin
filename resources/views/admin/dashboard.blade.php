@extends('admin.admin_layout.main')
@section('title', 'Dashboard')
@section('customcss')

@endsection
@section('content')
<div id="page-wrapper">
    <div class="main-page">
        <div class="col_3">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-dollar icon-rounded"></i>
                    <div class="stats">
                    <h5><strong>52</strong></h5>
                    <span>Total Machinery</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                    <div class="stats">
                    <h5><strong>19</strong></h5>
                    <span>Rent Machine</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-money user2 icon-rounded"></i>
                    <div class="stats">
                    <h5><strong>12</strong></h5>
                    <span>Hire Machine</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
                    <div class="stats">
                    <h5><strong>$450</strong></h5>
                    <span>Expenditure</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                    <div class="stats">
                    <h5><strong>3</strong></h5>
                    <span>Total Users</span>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')

@endsection