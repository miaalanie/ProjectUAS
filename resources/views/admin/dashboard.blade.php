@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Card: Login Confirmation --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
            <div class="p-6 text-gray-900">
                {{ __("You're logged in!") }}
            </div>
        </div>

        {{-- Dashboard Charts Container --}}
        <div class="container-fluid">
            <div class="row">
                {{-- Area Chart --}}
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                            <hr>
                            Styling for the area chart can be found in the 
                            <code>/js/demo/chart-area-demo.js</code> file.
                        </div>
                    </div>
                </div>

                {{-- Donut Chart --}}
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-pie pt-4">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <hr>
                            Styling for the donut chart can be found in the 
                            <code>/js/demo/chart-pie-demo.js</code> file.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
