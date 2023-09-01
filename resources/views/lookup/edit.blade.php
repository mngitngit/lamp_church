@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/app.js?time=') }}{{ time() }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <el-breadcrumb class="mb-4 mx-2" separator-class="el-icon-arrow-right">
                <el-breadcrumb-item><a href="/home?type=lookup">Look Up List</a></el-breadcrumb-item>
                <el-breadcrumb-item>View Details</el-breadcrumb-item>
            </el-breadcrumb>

            <edit-lookup-component :lookup="{{ $lookup }}" />
        </div>
    </div>
</div>
@endsection