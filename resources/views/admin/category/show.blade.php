@extends('admin.layout.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Kategória megtekintése</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        Név:
                        <input type="text" name="name_hu" value="{{$category->name_hu}}" disabled class="form-control">
                    </div>

                    <div class="form-group">
                        Létrehozás dátuma:
                        <input type="text" name="created_at" value="{{$category->created_at}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        Módosítás dátuma:
                        <input type="text" name="updated_at" value="{{$category->updated_at}}" disabled
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
