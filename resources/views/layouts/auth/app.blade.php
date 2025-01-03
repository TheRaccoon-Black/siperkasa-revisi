@extends('layouts.master')

@prepend('styles')
    @vite(['resources/css/app.css'])
@endprepend

@section('app')
    @include('layouts.auth.partials.header')
    <x-sidebar />
    <x-toast />
    @include('layouts.auth.partials.main')
    @include('layouts.auth.partials.footer')
@endsection

@prepend('scripts')
    @vite(['resources/js/app.js'])
@endprepend
