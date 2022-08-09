@extends('layouts.registration')

@section('content')
<div class="px-4">
    <ticket-component :registration="{{ $registration }}" />
</div>
@endsection