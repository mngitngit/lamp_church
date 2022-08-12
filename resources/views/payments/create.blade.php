@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <el-breadcrumb class="mb-3" separator-class="el-icon-arrow-right">
                <el-breadcrumb-item><a href="/home">All Registrations</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/payments/{{ $uuid }}">Payments</a></el-breadcrumb-item>
                <el-breadcrumb-item>Add</el-breadcrumb-item>
            </el-breadcrumb>

            <div class="card mb-3">
                <div class="card-header">{{ __('Payments') }}</div>

                <div class="card-body pb-0">
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <small>Name</small>
                            <span class="text-lg font-bold d-block text-uppercase">{{ $registration->firstname }} {{ $registration->lastname }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>AWTA Card Number</small>
                            <span class="text-md font-bold d-block">{{ $registration->uuid }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>Date Registered</small>
                            <span class="text-lg font-bold d-block">{{ $registration->created_at }}</span>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <small>Local Church</small>
                            <span class="text-md font-bold d-block">{{ $registration->local_church }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>Registration Type</small>
                            <span class="text-lg font-bold d-block">{{ $registration->registration_type }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>Country</small>
                            <span class="text-md font-bold d-block">{{ $registration->country }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top pb-0">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <small>Payment Status</small>
                            <span class="text-md font-bold d-block">{{ $registration->status ? 'Paid' : 'Unsettled' }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>Balance</small>
                            <span class="text-md font-bold d-block">{{ $balance }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>Recent Payment</small>
                            <span class="text-lg font-bold d-block">{{ $registration->created_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection