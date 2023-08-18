@extends('layouts.registration')

@section('content')
<div class="px-4">
    <registration-component :slots="{{ $slots }}"/>
</div>
@endsection

@section('footer')
<footer class="footer shadow">
    <div class="container py-2">
        <center>
            <span class="text-muted">Already registered? &nbsp;<a href="/booking"><el-button size="mini" type="warning" round>Manage Booking</el-button></a></span>
        </center>
    </div>
</footer>
@endsection