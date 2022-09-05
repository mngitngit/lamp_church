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
</div>
@endsection