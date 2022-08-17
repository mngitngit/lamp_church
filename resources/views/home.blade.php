@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-24">
            <a href="/registrations/export">
            <el-button type="success" class="float-end">Export to Excel&nbsp;<i class="el-icon-download el-icon-right"></i></el-button>
            </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-24">
            <div class="card">
                <div class="card-header">{{ __('All Registrations') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <registration-table :registrations="{{ $registrations }}" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
