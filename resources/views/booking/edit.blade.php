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
            <booking :booked_dates="{{ $booked_dates }}" :slots="{{ $slots }}" uuid="{{ $uuid }}" :can_book_days="{{ $registration->can_book_days }}" :self_redirect="{{ true }}" :is_admin="{{ true }}"/>
        </div>
    </div>

    @if (count($registration->booking_activities) > 0)
    <div class="justify-content-center my-lg-5 row">
        <div class="col-md-9">
            <label class="mb-3 text-secondary">Booking Activity</label>
            <el-timeline>
                @foreach ($registration->booking_activities as $activity)
                <el-timeline-item
                    type="default"
                    size="large"
                    timestamp="{{ $activity['timestamp'] }}">
                    {{ $activity['message'] }}
                </el-timeline-item>
                @endforeach
            </el-timeline>
        </div>
    </div>
    @endif
</div>
@endsection