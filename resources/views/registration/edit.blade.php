@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/app.js?time=') }}{{ time() }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <el-breadcrumb class="mb-3" separator-class="el-icon-arrow-right">
                <el-breadcrumb-item><a href="/home">All Registrations</a></el-breadcrumb-item>
                <el-breadcrumb-item>Edit Delegate Details</el-breadcrumb-item>
            </el-breadcrumb>

            <edit-registration-component :registration="{{ $registration }}"></edit-registration-component>
        </div>
    </div>

    <div class="justify-content-center my-lg-5 row">
        @if (count($registration->notes) > 0)
        <div class="col-md-3">
            <label class="mb-3 text-secondary">Notes</label>
            @foreach ($registration->notes as $note)
            <el-card class="mb-3" shadow="never">
                <b>{{ $note['user']}}</b>: {{ $note['message'] }}<br />
                <small>{{ $note['timestamp'] }}</small>
            </el-card>
            @endforeach
        </div>
        @endif
        <div @if (count($registration->notes) > 0) class="col-md-6" @else class="col-md-9" @endif>
            @if (count($registration->activities) > 0)
                <label class="mb-3 text-secondary">Activity</label>
                <el-timeline>
                    @foreach ($registration->activities as $activity)
                    <el-timeline-item
                        type="default"
                        size="large"
                        timestamp="{{ $activity['timestamp'] }}">
                        {{ $activity['user'] }} {{ $activity['message'] }}
                    </el-timeline-item>
                    @endforeach
                </el-timeline>
            @else
            <el-empty description="No recorded activity"></el-empty>
            @endif
        </div>
    </div>
</div>
@endsection