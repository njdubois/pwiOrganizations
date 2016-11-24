@extends('parts.layouts.admin_layout')

@section("extraCss")
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/org_listing.css">
@endsection

@section('body_content')
    <div class="admin_body_div">
        <div align="center">
            @include('parts.organization_list')
        </div>

        <div align="right">
            <hr />

            <a class="green_button" href="{{ route("adminOrganizationCreate") }}" >
                CREATE NEW
            </a>
        </div>
    </div>
@endsection