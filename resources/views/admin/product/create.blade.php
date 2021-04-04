@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Termékek</a></li>
    <li class="breadcrumb-item active">Termék feltöltése</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Termék feltöltése</h3>
                </div>
                @include('admin.product.form')
            </div>
        </div>
    </div>
@stop
