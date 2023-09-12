@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/booking.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <el-breadcrumb class="mb-4 mx-2" separator-class="el-icon-arrow-right">
                <el-breadcrumb-item><a href="/home">All Registrations</a></el-breadcrumb-item>
                <el-breadcrumb-item class="text-highlight">View Details</el-breadcrumb-item>
            </el-breadcrumb>

            <div class="el-tabs el-tabs--top el-tabs--border-card">
                <div class="el-tabs__header is-top">
                    <div class="el-tabs__nav-wrap is-top">
                        <div class="el-tabs__nav-scroll">
                            <div role="tablist" class="el-tabs__nav is-top" style="transform: translateX(0px);">
                                <div id="tab-0" aria-controls="pane-0" role="tab" tabindex="0" class="el-tabs__item is-top">
                                    <el-link :underline="false" href="/registration/{{ $registration->uuid }}/edit">Registration Details</el-link>
                                </div>
                                <div id="tab-1" aria-controls="pane-1" role="tab" tabindex="-1" class="el-tabs__item is-top">
                                    <el-link :underline="false" href="/payments/{{ $registration->uuid }}/create">Payments</el-link>
                                </div>
                                @if (auth()->user()->permissions->can_edit_delegate === 1 && $registration->attending_option === 'Hybrid')
                                <div id="tab-2" aria-controls="pane-2" role="tab" tabindex="-1" class="el-tabs__item is-top is-active">
                                    <el-link :underline="false" href="/booking/{{ $registration->uuid }}/edit">Booking</el-link>
                                </div>
                                @endif
                                <div id="tab-3" aria-controls="pane-3" role="tab" tabindex="-1" class="el-tabs__item is-top">
                                    <el-link :underline="false" href="/ticket/{{ $registration->id }}/edit">Ticket</el-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="el-tabs__content">
                    <p>Booking Status: <el-tag type="{{$registration->booking_status === 'Confirmed' ? 'success' : ($registration->booking_status === 'Cancelled' ? 'danger' : 'warning')}}">{{ $registration->booking_status }}</el-tag></p>
                    <p>Date Booked: {{ date("M d, Y h:i A", strtotime($registration->booked_date)) }}</p>
                    
                    <booking :booked_dates="{{ $booked_dates }}" :slots="{{ $slots }}" uuid="{{ $uuid }}" :can_book_days="{{ $registration->can_book_days }}" :self_redirect="{{ true }}" :is_admin="{{ true }}"/>
                </div>
            </div>
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