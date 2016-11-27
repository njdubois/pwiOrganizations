@extends('parts.layouts.home_layout')

@section("extraCss")

@endsection

@section('body_content')
    <div class="header_banner">

    </div>

    <div align="center">
        @include('parts.organization_list')
    </div>
@endsection