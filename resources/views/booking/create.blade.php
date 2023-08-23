@extends('layouts.booking')

@section('content')
<div class="px-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <img width="100%" class="mb-3 rounded shadow" src="/images/2023_banner.jpg">
        </div>
    </div>
    
    <manage-booking />
</div>
@endsection

@section('footer')
<footer class="footer shadow">
    <div class="container py-2">
        <center>
            <span class="text-muted">Not yet registered? &nbsp;<el-link href="/registration" type="theme">Register</el-link></span>
        </center>
    </div>
</footer>
@endsection