@extends('layouts.checkin')

@section('content')
<div class="px-4">
    <online-checkin :loc="{{ json_encode($loc) }}" />
</div>
@endsection