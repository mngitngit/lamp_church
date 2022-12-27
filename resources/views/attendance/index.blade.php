@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/attendance.js') }}" defer></script>
@endsection

@section('content')
<attendance-component :count="{{ $count }}" />
@endsection