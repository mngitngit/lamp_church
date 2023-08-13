@extends('layouts.registration')

@section('content')
<div class="px-4">
    <ticket-component :registrations="{{ json_encode($registration) }}" />
    <div class="row justify-content-center">
        <div class="col-md-6">
            <el-link type="primary" class="float-end" href="/registration">Register Another Delegate</el-link>
        </div>
    </div>
</div>
@endsection