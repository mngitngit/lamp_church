@extends('layouts.booking')

@section('content')
<div class="px-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <img width="100%" class="mb-3 rounded shadow" src="/images/booking_banner.jpg">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <manage-booking />
        </div>
    </div>
</div>
@endsection