@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/scss/widgets.css') }}">
@endsection

@section('content-title')
		REPORTS
@endsection

@section('content')
<button type="button" class="btn btn-primary btn-lg btn-block" style="width:500px;">Property Transfer Report</button>

@endsection

@section('addJS')
   <script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('sufee-admin-dashboard-master/assets/js/widgets.js') }}"></script>
@endsection
