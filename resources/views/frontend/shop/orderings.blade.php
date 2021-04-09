@extends('frontend.layout.default-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <h1 class="mt-5">Rendelések</h1>

                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th class="align-top">Név</th>
                        <th class="align-top">Kategória<br>Alkategória</th>
                        <th class="align-top">Ár</th>
                        <th class="align-top">Rendelt DB</th>
                        <th class="align-top">Végösszeg</th>
                        <th class="align-top">Szállítási mód</th>
                        <th class="align-top">Sz. költség</th>
                        <th class="align-top">Rendelés dátuma</th>
                        <th class="align-top">Értékelés</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->product->name_hu}}
                                {{--other pictures indicator--}}
                                @if(count($order->product->attachments)>0)
                                    <span class="font-weight-bold">***</span>
                                @endif <br>
                                {{--avatar--}}
                                <a href="{{ \Storage::disk('dev')->url($order->product->avatar_path)}}">
                                    <img src="{{ \Storage::disk('dev')->url($order->product->avatar_path)}}"
                                         alt="{{$order->product->avatar}}" width="50">
                                </a><br>
                                {{--download link--}}
                                <a href="{{route('admin.avatar.download',
                                        [ 'path'  =>  $order->product->avatar_path,
                                          'name'  =>  $order->product->avatar
                                          ])}}">Letöltés</a>
                            </td>
                            <td><span class="font-weight-bold">
                                        @if(\Str::length($order->product->subCategory->category->name_hu)>13)
                                        <a href="#" title="{{$order->product->subCategory->category->name_hu}}">
                                                {{\Str::limit($order->product->subCategory->category->name_hu,$limit =
                                                13, $end = '...')}}
                                            </a>
                                    @else
                                        {{$order->product->subCategory->category->name_hu}}
                                    @endif
                                    </span>
                                <br>
                                @if(\Str::length($order->product->subCategory->name_hu)>10)
                                    <a href="#" title="{{$order->product->subCategory->name_hu}}">
                                        {{\Str::limit($order->product->subCategory->name_hu,$limit = 10, $end = '...')}}
                                    </a>
                                @else
                                    {{$order->product->subCategory->name_hu}}
                                @endif
                            </td>
                            <td>{{$order->product->price_hu}}
                                {{strtoupper($order->product->payment_unit)}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->total_amount}} {{strtoupper($order->product->payment_unit)}}</td>
                            <td>{{$order->transport->mode_hu}}</td>
                            <td>
                                @if($order->transport->extra_cost!=null)
                                    {{$order->transport->extra_cost}}
                                    {{strtoupper($order->product->payment_unit)}}
                                @else
                                    Nincs
                                @endif
                            </td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                @if($order->completed)
                                    <a href="{{route('visitors.shop.opinion', [
                                          'orderId' => $order->id,
                                          'productId' => $order->product->id
                                        ])}}"
                                       class="btn btn-primary mt-1">
                                        @if(
                                          in_array(authCustomer()->id,$order->product->comments->pluck('customer_id')->toArray())
                                            &&
                                          in_array(authCustomer()->id,$order->product->ratings->pluck('customer_id')->toArray())
                                        )
                                            Mutat
                                        @else
                                            Értékelés
                                        @endif
                                    </a>
                                @else
                                    Rendelés folyamatban
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if (count($orders)==0)
                        <td colspan="11"><h4 class="text-center font-weight-bold">Önhöz nem tartozik leadott
                                rendelés</h4></td>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
