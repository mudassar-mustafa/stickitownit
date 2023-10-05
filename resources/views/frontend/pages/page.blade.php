@extends('frontend.layouts.app')
@section('title',$page->name ?? "")
@push('css')
@endpush
@section('content')
    <main>
        {!! $page->body ?? "" !!}
        @include('frontend.includes.social')

    </main>
@endsection
@push('js')
@endpush
