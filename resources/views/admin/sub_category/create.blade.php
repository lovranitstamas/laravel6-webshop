@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.sub_category.index')}}">Alkategóriák</a></li>
    <li class="breadcrumb-item active">Alkategória létrehozása</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Alkategória létrehozása</h3>
                </div>
                @include('admin.sub_category.form')
            </div>
        </div>
    </div>
@stop
