@extends('core::layouts.master')

@section('content')

<content-layer>
</content-layer>
@endsection


@push("footer_scripts")
{{-- <script src="{{ mix('js/support.js') }}"></script> --}}
@endpush

@push("header_scripts")
 {{-- <link rel="stylesheet" href="{{ mix('css/support.css') }}"> --}}
@endpush
