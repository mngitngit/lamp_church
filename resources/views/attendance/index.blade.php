@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/attendance.js') }}" defer></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <attendance-component :count="{{ $count }}" />
    </div>
</div>
@endsection