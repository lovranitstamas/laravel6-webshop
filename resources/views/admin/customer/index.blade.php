@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item active">Vásárlók</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Vásárlók</h3>

                    <div class="card-tools">
                        {{-- <a href="{{route('admin.product.create')}}" class="btn btn-primary">Termék létrehozása</a>--}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th class="align-top">#</th>
                            <th class="align-top">Vezetéknév</th>
                            <th class="align-top">keresztnév</th>
                            <th class="align-top">E-mail</th>
                            <th class="align-top">Irszám</th>
                            <th class="align-top">Város</th>
                            <th class="align-top">Utca, házszám</th>
                            <th class="align-top">Telefonszám</th>
                            <th class="align-top">Regisztráció dátuma</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->surname}}</td>
                                <td>{{$customer->forename}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->zipcode}}</td>
                                <td>{{$customer->city}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->created_at}}<br>
                            </tr>
                        @endforeach
                        @if (count($customers)==0)
                            <td colspan="9">
                                <h4 class="text-center font-weight-bold">A rendszer nem tartalmaz
                                    felhasználót</h4>
                            </td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
