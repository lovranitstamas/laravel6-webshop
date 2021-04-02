@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.transport.index')}}">Szállítási módok</a></li>
    <li class="breadcrumb-item active">Szállítási mód megtekintése</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Szállítási mód megtekintése</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        Szállítási mód neve:
                        <input type="text" name="mode_hu" value="{{$transport->mode_hu}}" disabled class="form-control">
                    </div>

                    <div class="form-group">
                        Létrehozás dátuma:
                        <input type="text" name="created_at" value="{{$transport->created_at}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        Módosítás dátuma:
                        <input type="text" name="updated_at" value="{{$transport->updated_at}}" disabled
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
