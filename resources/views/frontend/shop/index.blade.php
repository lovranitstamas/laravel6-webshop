@extends('frontend.layout.default-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-5">Termékek</h1>

                <form action="{{route('visitors.shop')}}" method="GET">
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
                            <th class="align-top">Sz. költség</th>
                            <th class="align-top">Megtekintés</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="search[name_hu]"
                                       value="{{request()->input('search.name_hu')}}">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm"
                                       name="search[subCategory][category][name_hu]"
                                       value="{{request()->input('search.subCategory.category.name_hu')}}">
                                <input type="text" class="form-control form-control-sm"
                                       name="search[subCategory][name_hu]"
                                       value="{{request()->input('search.subCategory.name_hu')}}">

                            </td>
                            <td></td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="search[price_hu]"
                                       value="{{request()->input('search.price_hu')}}">
                            </td>
                            <td></td>
                            <td>
                                <div class="btn-group">
                                    <input role="button" type="submit" class="btn btn-primary btn-sm" value="Keresés">
                                    <a role="button" class="btn btn-default btn-sm" href="{{route('visitors.shop')}}"
                                       title="Keresési feltételek törlése"><i class="fa fa-sync"></i></a>
                                </div>
                            </td>

                        </tr>
                        @foreach($products as $product)

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
                                        @if(\Str::length($product->subCategory->category->name_hu)>13)
                                            <a href="#" title="{{$product->subCategory->category->name_hu}}">
                                                {{\Str::limit($product->subCategory->category->name_hu,$limit = 13, $end = '...')}}
                                            </a>
                                        @else
                                            {{$product->subCategory->category->name_hu}}
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
                                    @foreach($product->modeOfTransports()->pluck('extra_cost')->toArray() as
                                    $extra_cost)
                                        @if($extra_cost!==null)
                                            {{$extra_cost}} FT
                                        @else
                                            Nincs
                                        @endif
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('visitors.shop.show', [
                                          'product' => $product->id,
                                         'page' => request()->input('page') ?: 1
                                        ])}}"
                                       class="btn btn-info btn-sm">Egyéb részletek</a>
                                </td>
                            </tr>

                        @endforeach
                        @if (count($products)==0)
                            <td colspan="6"><h4 class="text-center font-weight-bold">A raktárkészlet üres</h4></td>
                        @endif
                        </tbody>
                    </table>
                </form>
                {{$products->links()}}
            </div>
        </div>
    </div>
@stop
