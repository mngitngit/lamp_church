@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/registration.js?time=') }}{{ time() }}" defer></script>
@endsection

@section('content')
<div class="mx-4">
    <el-tabs type="border-card" value="{{ $tab }}">
        {{-- Registration --}}
        <el-tab-pane label="Registrations">
            <registration-table />                        
        </el-tab-pane>

        {{-- Look Up --}}
        <el-tab-pane label="Look Up">
            <lookups-table />
        </el-tab-pane>

        {{-- Bookings --}}
        <el-tab-pane label="Bookings">
            <!-- {{json_encode($slots)}} -->
            <booking-table :slots="{{ json_encode($slots) }}" />
        </el-tab-pane>

        {{-- Attendance --}}
        <el-tab-pane label="Attendance">
            <attendance-table :count="{{ $count }}" :overall="{{ $overall }}" :overall_total="{{ $overall_total }}" />
        </el-tab-pane>

        <el-tab-pane label="Slots">
            <slots-table :slots="{{ $slots_list }}" />
        </el-tab-pane>
    </el-tabs>
</div>
@endsection
