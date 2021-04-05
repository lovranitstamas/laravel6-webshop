@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Vásárlók</a></li>
    <li class="breadcrumb-item active">Vásárló megtekintése</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Vásárló megtekintése</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="id">#</label>
                        <input type="text" name="id" id="id" value="{{$customer->id}}" disabled class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name_hu">Név:</label>
                        <input type="text" name="name_hu" id="name_hu"
                               value="{{$customer->surname}} {{$customer->forename}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" id="email"
                               value="{{$customer->email}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="zipcode">Irányítószám:</label>
                        <input type="text" name="zipcode" id="zipcode"
                               value="{{$customer->zipcode}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="city">Város:</label>
                        <input type="text" name="city" id="city"
                               value="{{$customer->city}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="address">Utca, házszám:</label>
                        <input type="text" name="address" id="address"
                               value="{{$customer->address}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name_hu">Telefonszám:</label>
                        <input type="text" name="phone" id="phone"
                               value="{{$customer->phone}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="created_at">Létrehozás dátuma:</label>
                        <input type="text" name="created_at" disabled value="{{$customer->created_at}}"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="updated_at">Módosítás dátuma:</label>
                        <input type="text" name="updated_at" disabled value="{{$customer->updated_at}}"
                               class="form-control">
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
