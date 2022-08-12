@extends('layouts.app')

@section('content')
<div class="container">
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
