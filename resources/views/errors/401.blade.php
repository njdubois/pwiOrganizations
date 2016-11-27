@extends('parts.layouts.admin_layout')

@section("extraCss")

@endsection

@section('body_content')
    <div class="admin_body_div">
        <p class="error_text">
            401, You are not authorized to view this page.  Please log in.
        </p>
        @if(env("APP_DEBUG") == true)
            {{$exception->getMessage()}}
        @endif

    </div>
@endsection