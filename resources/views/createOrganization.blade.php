@extends('parts.layouts.admin_layout')

@section("extraCss")

@endsection

@section('body_content')
    <div class="admin_body_div" align="center">
        @include('parts.organization_form')
    </div>
@endsection