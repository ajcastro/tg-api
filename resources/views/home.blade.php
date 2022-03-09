@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-8"></div>
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
            @include('partials.login-card')
        </div>
    </div>
</div>
@endsection
