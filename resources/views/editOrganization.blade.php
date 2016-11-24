@extends('parts.layouts.admin_layout')

@section("extraCss")
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/org_Form.css">
@endsection

@section('body_content')
    <div class="admin_body_div" align="center">
        @include('parts.organization_form')
    </div>
@endsection