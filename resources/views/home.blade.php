@extends('layouts.master')
@include('navbar.header')
@section('content')
@include('sidebar.dashboard')
<link rel="stylesheet" href="{{URL::to('assets/css/dashboard.css')}}">
<main class="col bg-faded py-3 flex-grow-1">
    <div class="container-xl">
        <div class="container bootstrap snippets bootdey">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="mini-stat clearfix bg-mine rounded">
                        <span class="mini-stat-icon fg-mine"> 1 </span>
                        <div class="mini-stat-info">
                            <span>{{ $urlCount }}</span>
                            <br>
                            My Shortened URLs
                        </div>
                    </div>
                </div>
                @if($loggedInUser->role == 'admin')
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="mini-stat clearfix bg-ten rounded">
                            <span class="mini-stat-icon fg-ten"> 10 </span>
                            <div class="mini-stat-info">
                                <span>{{ $all['ten_url_limit'] }}</span>
                                <br>
                                Ten Shortened URLs
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="mini-stat clearfix bg-thousand rounded">
                            <span class="mini-stat-icon fg-thousand">1000</i></span>
                            <div class="mini-stat-info">
                                <span>{{ $all['thousand_url_limit'] }}</span>
                                <br>
                                Thousand Shortened URLs
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="mini-stat clearfix bg-unlimited rounded">
                            <span class="mini-stat-icon fg-unlimited unlimited"> LIMIT </span>
                            <div class="mini-stat-info">
                                <span>{{ $all['unlimited_url_limit'] }}</span>
                                <br>
                                Unlimited Shortened URLs
                            </div>
                        </div>
                    </div> 
                @endif       
            </div>
        </div>
    </div>
</main>
@endsection