@extends('admin.layout.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Alkategória módosítása</h3>
                </div>
                @include('admin.sub_category.form')
            </div>
        </div>
    </div>
@stop
