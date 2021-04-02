@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.transport.index')}}">Szállítási módok</a></li>
    <li class="breadcrumb-item active">Szállítási mód szerkesztése</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Szállítás módosítása</h3>
                </div>
                @include('admin.transport.form')
            </div>
        </div>
    </div>
@stop
