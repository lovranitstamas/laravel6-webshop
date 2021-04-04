@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item active">Rendelések</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Termékek</h3>

                    <div class="card-tools">
                        {{-- <a href="{{route('admin.product.create')}}" class="btn btn-primary">Termék létrehozása</a>--}}
                    </div>
                    <br>*** jelenleg mindegy egyes leadott rendelés egy terméket tartalmazhat
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th class="align-top">Kódszám</th>
                            <th class="align-top">Vásárló</th>
                            <th class="align-top">Termék</th>
                            <th class="align-top">Mennyiség</th>
                            <th class="align-top">Végösszeg</th>
                            <th class="align-top">Teljesítve</th>
                            <th class="align-top">Rendelés dátuma</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>
                                    <a href="{{route('admin.customer.edit', $order->customer->id)}}">
                                        {{$order->customer->surname}} {{$order->customer->forename}}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('admin.product.edit', $order->product->id)}}">
                                        {{$order->product->name_hu}}
                                    </a>
                                </td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->total_amount}}</td>
                                <td>
                                    @if($order->completed==1)
                                        Aktív
                                    @else
                                        Inaktív
                                    @endif
                                </td>
                                <td>{{$order->created_at}}<br>

                            </tr>
                        @endforeach
                        @if (count($orders)==0)
                            <td colspan="7"><h4 class="text-center font-weight-bold">A rendszer nem tartalmaz
                                    rendelést</h4></td>
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
