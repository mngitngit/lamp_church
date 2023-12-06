@extends('layouts.checkin')

@section('content')
<div class="px-4">
    {{-- <div class="row justify-content-center">
        <div class="col-md-3">
            <img width="100%" class="mb-3 rounded shadow" src="/images/2023_banner.jpg">
        </div>
    </div> --}}
    
    <online-checkin :loc="{{ json_encode($loc) }}" />
</div>
@endsection