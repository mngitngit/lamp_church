@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/app.js?time=') }}{{ time() }}" defer></script>
@endsection

@section('content')
<div class="px-4">
    <el-tabs type="border-card">
        <upload-component>
    </el-tabs>
</div>
@endsection