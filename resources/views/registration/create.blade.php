@extends('layouts.registration')

@section('content')
<div class="px-4">
    <registration-component :slots="{{ $slots }}"/>
</div>
@endsection