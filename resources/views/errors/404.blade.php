@extends('parts.layouts.admin_layout')

@section("extraCss")

@endsection

@section('body_content')
    <div class="admin_body_div">
        <p class="error_text">
            404, Not Found.
        </p>
        @if(env("APP_DEBUG") == true)
            {{$exception->getMessage()}}
        @endif

    </div>
@endsection