@extends('layouts.registration')

@section('content')
<div class="px-4">
    <ticket-component :registration="{{ $registration }}" :booked_dates="{{ json_encode($booked_dates) }}" />
</div>
@endsection