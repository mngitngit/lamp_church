@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/activities.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <activites-table :activities="{{ json_encode($activities) }}"/>
        </div>
    </div>
</div>
@endsection