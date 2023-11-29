@extends('layouts.dashboard')

@section('scripts')
<script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection

@section('content')
    <dashboard-component 
        :all="{{ json_encode($all) }}"
        :members="{{ json_encode($members) }}" 
        :guests="{{ json_encode($guests) }}"
        :trend="{{ json_encode($trend) }}"
        :progress="{{ json_encode($progress) }}"
        :received_hg="{{ json_encode($received_hg) }}" />
@endsection