@extends('layouts.dashboard')

@section('scripts')
<script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection

@section('content')
<dashboard-attendance-component :absents="{{ json_encode($absents) }}"/>
@endsection