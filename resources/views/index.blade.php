@extends('parts.layouts.home_layout')

@section("extraCss")
    <link rel="stylesheet" href="/css/org_listing.css">
@endsection

@section('body_content')
    <div class="header_banner">

    </div>

    <div align="center">
        @include('parts.organization_list')
    </div>
@endsection