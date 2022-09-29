@extends('layouts.registration')

@section('content')
<div class="px-4">
    <div class="row justify-content-center my-4">
        <div class="col-md-6">
            <ticket-component :registration="{{ $registration }}" :booked_dates="{{ json_encode($booked_dates) }}" />
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <el-link type="primary" class="float-end" href="/booking">Book Another Delegate</el-link>
        </div>
    </div>
</div>
@endsection