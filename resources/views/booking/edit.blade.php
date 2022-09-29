@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/booking.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <el-breadcrumb class="mb-3" separator-class="el-icon-arrow-right">
                <el-breadcrumb-item><a href="/home">All Registrations</a></el-breadcrumb-item>
                <el-breadcrumb-item>Booking</el-breadcrumb-item>
            </el-breadcrumb>
            <booking :booked_dates="{{ $booked_dates }}" :slots="{{ $slots }}" uuid="{{ $uuid }}" :can_book_days="{{ $can_book_days }}"/>
        </div>
    </div>
</div>
@endsection