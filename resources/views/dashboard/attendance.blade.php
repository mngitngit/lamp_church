@extends('layouts.dashboard')

@section('content')
<dashboard-attendance-component :absents="{{ json_encode($absents) }}"/>
@endsection