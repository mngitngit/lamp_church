@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/attendance.js?time=') }}{{ time() }}" defer></script>
@endsection

@section('content')
<attendance-component :count="{{ $count }}" />
@endsection