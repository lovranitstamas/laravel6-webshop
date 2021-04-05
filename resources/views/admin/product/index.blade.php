@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item active">Termékek</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Termékek</h3>

                    <div class="card-tools">
                        <a href="{{route('admin.product.create')}}" class="btn btn-primary">Termék létrehozása</a>
                    </div>
                    <br>*** a termékez több kép is tartozik
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th class="align-top">#</th>
                            <th class="align-top">Név</th>
                            <th class="align-top">Kategória<br>Alkategória</th>
                            <th class="align-top">Státusz</th>
                            <th class="align-top">Raktárkészlet</th>
                            <th class="align-top">Ár</th>
                            <th class="align-top">F. egység</th>
                            <th class="align-top">Szállítási mód</th>
                            <th>Létrehozás dátuma<br>
                                Módosítás dátuma
                            </th>
                            <th>Megtekintés<br>Módosítás</th>
                            <th class="align-top">Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name_hu}}
                                    {{--other pictures indicator--}}
                                    @if(count($product->attachments)>0)
                                        <span class="font-weight-bold">***</span>
                                    @endif <br>
                                    {{--avatar--}}
                                    <a href="{{ \Storage::disk('dev')->url($product->avatar_path)}}">
                                        <img src="{{ \Storage::disk('dev')->url($product->avatar_path)}}"
                                             alt="{{$product->avatar}}" width="50">
                                    </a><br>
                                    {{--download link--}}
                                    <a href="{{route('admin.avatar.download',
                                        [ 'path'  =>  $product->avatar_path,
                                          'name'  =>  $product->avatar
                                          ])}}">Letöltés</a>
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
                                    @if($product->state==1)
                                        Aktív
                                    @else
                                        Inaktív
                                    @endif
                                </td>
                                <td>{{$product->inventory}} DB</td>
                                <td>{{$product->price_hu}}</td>
                                <td>{{strtoupper($product->payment_unit)}}</td>
                                <td>
                                    {{--@if($product->mode_of_transport_id==null)--}}
                                        @foreach($product->modeOfTransports()->pluck('mode_hu')->toArray() as
                                        $transport)
                                            @if(\Str::length($transport)>10)
                                                <a href="#" title="{{$transport}}">
                                                    {{\Str::limit($transport, $limit = 10,$end = '...')}}
                                                </a>
                                            @else
                                                {{$transport}}
                                            @endif
                                            <br>
                                        @endforeach
                                   {{-- @else
                                        @if(\Str::length($product->modeOfTransport->mode_hu)>10)
                                            <a href="#" title="{{$product->modeOfTransport->mode_hu}}">
                                                {{\Str::limit($product->modeOfTransport->mode_hu, $limit = 10,$end='...')}}
                                            </a>
                                        @else
                                            {{$product->modeOfTransport->mode_hu}}
                                        @endif
                                    @endif--}}
                                </td>
                                <td>{{$product->created_at}}<br>
                                    {{$product->updated_at}}</td>
                                <td>

                                    <a href="{{route('admin.product.show', $product->id)}}"
                                       class="btn btn-info btn-sm">Megtekintés</a><br>
                                    {{--['id' => $category->id]--}}
                                    @if($product->orders()->count()==0)
                                        <a href="{{route('admin.product.edit', $product->id)}}"
                                           class="btn btn-default btn-sm mt-1 w-100">Módosítás</a>
                                    @else
                                        Tiltás alatt
                                    @endif

                                </td>
                                <td>
                                    @if($product->orders()->count()==0)
                                        <form action="{{route('admin.product.destroy', $product->id)}}" method="POST">
                                            <input type="hidden" name="_method" value="delete">
                                            @csrf
                                            <input type="submit" name="button" value="Törlés" class="btn btn-danger">
                                        </form>
                                    @else
                                        Tiltás alatt
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if (count($products)==0)
                            <td colspan="11"><h4 class="text-center font-weight-bold">A raktárkészlet üres</h4></td>
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
