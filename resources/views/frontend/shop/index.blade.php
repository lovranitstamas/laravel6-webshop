@extends('frontend.layout.default-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-5">Termékek</h1>

                <table class="table table-hover text-nowrap mt-3">
                    <thead>
                    <tr>
                        <th class="align-top">Főkép</th>
                        <th class="align-top">{!! orderTableHeader('name_hu','Név')!!}</th>
                        <th class="align-top">Kategória<br>Alkategória</th>
                        <th class="align-top">Raktárkészlet</th>
                        {{-- <th class="align-top">Ár</th>--}}
                        <th class="align-top">{!! orderTableHeader('price_hu', 'Ár') !!}</th>
                        <th class="align-top">Szállítási mód</th>
                        <th class="align-top">Megtekintés</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        @if($product->state==1)
                            <tr>
                                <td>
                                    {{--avatar--}}
                                    <a href="{{ \Storage::disk('dev')->url($product->avatar_path)}}">
                                        <img src="{{ \Storage::disk('dev')->url($product->avatar_path)}}"
                                             alt="{{$product->avatar}}" width="50">
                                    </a>
                                </td>
                                <td>{{$product->name_hu}}
                                    {{--other pictures indicator--}}
                                    @if(count($product->attachments)>0)
                                        <span class="font-weight-bold">***</span>
                                    @endif <br>
                                </td>
                                <td><span class="font-weight-bold">
                                        @if(\Str::length($product->category->name_hu)>13)
                                            <a href="#" title="{{$product->category->name_hu}}">
                                                {{\Str::limit($product->category->name_hu,$limit = 13, $end = '...')}}
                                            </a>
                                        @else
                                            {{$product->category->name_hu}}
                                        @endif
                                    </span>
                                    <br>
                                    @if(\Str::length($product->subCategory->name_hu)>10)
                                        <a href="#" title="{{$product->subCategory->name_hu}}">
                                            {{\Str::limit($product->subCategory->name_hu,$limit = 10, $end = '...')}}
                                        </a>
                                    @else
                                        {{$product->subCategory->name_hu}}
                                    @endif
                                </td>
                                <td>
                                    @if($product->inventory>0)
                                        Raktáron
                                    @else
                                        Nincs raktáron
                                    @endif
                                </td>
                                <td>{{$product->price_hu}} {{strtoupper($product->payment_unit)}}</td>
                                <td>
                                    @foreach($product->modeOfTransports()->pluck('mode_hu')->toArray() as
                                    $transport)
                                        {{$transport}} <br>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('admin.product.show', $product->id)}}"
                                       class="btn btn-info btn-sm">Megtekintés</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @if (count($products)==0)
                        <td colspan="6"><h4 class="text-center font-weight-bold">A raktárkészlet üres</h4></td>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
