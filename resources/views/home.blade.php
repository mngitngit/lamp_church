@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/registration.js?time=') }}{{ time() }}" defer></script>
@endsection

@section('content')
<div class="container">
    <el-tabs type="border-card">
        <el-tab-pane label="Registrations">
            <div class="row">
                <div class="col-md-5 mb-3">
                    <form method="GET" action="{{ url('home') }}">
                        <div class="input-with-select el-input el-input-group el-input-group--append">
                            <input type="text" autocomplete="off" placeholder="Search by Name or ID" name="search" value="{{ $search }}" class="el-input__inner">
                            <div class="el-input-group__append">
                                <button type="submit" class="el-button el-button--submit" value="Submit">
                                    <i class="el-icon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 mb-3">
                    <a href="/registrations/export">
                    <el-button type="success" class="float-end">Export to Excel&nbsp;<i class="el-icon-download el-icon-right"></i></el-button>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-24">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <registration-table :registrations="{{ json_encode($registrations) }}" />                        
                </div>
                <div class="col-md-24 pt-3">
                    {{ $registrations->links() }}
                </div>
            </div>
        </el-tab-pane>
        <el-tab-pane label="Bookings">
            <booking-table :slots="{{ json_encode($slots) }}" />
        </el-tab-pane>
    </el-tabs>
</div>
@endsection
