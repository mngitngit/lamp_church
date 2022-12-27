@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/attendance.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <attendance-component :count="{{ $count }}" />
</div>
@endsection