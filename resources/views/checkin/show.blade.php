@extends('layouts.checkin')

@section('content')
<div class="px-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($_REQUEST['id'] == $all)
            <el-link type="primary" class="float-end" href="/check-in">Check In Another Delegate</el-link>
            @else
            <el-link type="primary" class="float-end" href="/check-in/passes?id={{ $all }}">View All Passes</el-link>
            @endif
        </div>
    </div>

    <div class="row justify-content-center my-4">
        <checkin-passes :passes="{{ json_encode($passes) }}" />
    </div>
</div>
@endsection