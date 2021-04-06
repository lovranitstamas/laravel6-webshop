@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Termékek</a></li>
    <li class="breadcrumb-item active">Termék megtekintése</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Termék megtekintése</h3>
                </div>
                <div class="box-body">

                    {{--id--}}

                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="id">#</label>
                        <input type="text" name="id" id="id" value="{{$product->id}}" disabled class="form-control">
                    </div>

                    @csrf

                    {{--name--}}
                    <div class="form-group">
                        <label for="name_hu">Termék neve:</label>
                        <input type="text" name="name_hu" id="name_hu" value="{{$product->name_hu}}" disabled
                               class="form-control">
                    </div>

                    {{--avatar--}}
                    <div class="form-group">
                        <span class="font-weight-bold">Avatar kép</span><br>
                        <a href="{{ \Storage::disk('dev')->url($product->avatar_path)}}">
                            <img src="{{ \Storage::disk('dev')->url($product->avatar_path)}}"
                                 alt="{{$product->avatar}}" width="50">
                        </a><br>
                        <a href="{{route('admin.avatar.download',
                                        [ 'path'  =>  $product->avatar_path,
                                          'name'  =>  $product->avatar
                                          ])}}">Letöltés</a>
                    </div>

                    {{--other attachments--}}
                    @if(count($product->attachments)>0)
                        <div class="form-group">
                            <span class="font-weight-bold">Egyéb kép(ek)</span><br>
                            @foreach($product->attachments as $attachment)
                                <a href="{{ $attachment->publicUrl()  }}">
                                    <img src="{{$attachment->publicUrl()}}" alt="picture" width="70">
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{--(sub) category--}}
                    <div class="form-group">
                        <label for="sub_category_id">Kategória kiválasztása:</label>
                        <select name="sub_category_id" id="sub_category_id" class="form-control" disabled>
                            <option value="0">Kérem válasszon!</option>
                            @foreach($subCategories as $subCategory)
                                @if($product->subCategory()->count()==0)
                                    <option value="{{$subCategory->id}}"
                                        {{$subCategory->id == old('sub_category_id') ? 'selected': ''}}>
                                        {{$product->subCategory->category->name_hu}} - {{$subCategory->name_hu}}
                                    </option>
                                @else
                                    <option value="{{$subCategory->id}}"
                                        {{$product->subCategory->id == $subCategory->id ? 'selected': ''}}>
                                        {{$product->subCategory->category->name_hu}} - {{$subCategory->name_hu}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{--state--}}
                    <div class="form-group">
                        <label for="state">Státusz:</label>
                        <select name="state" id="state" class="form-control" disabled>
                            <option value="-1">Kérem válasszon!</option>
                            @if($product->id)
                                <option value="1" {{$product->state==1 ? 'selected':''}}>Aktív</option>
                                <option value="0" {{$product->state==0 ? 'selected':''}}>Inaktív</option>
                            @endif
                        </select>
                    </div>

                    {{--inventory--}}
                    <div class="form-group">
                        <label for="inventory">Raktárkészlet (db):</label>
                        <input type="text" name="inventory" id="inventory"
                               value="{{$product->inventory}}"
                               class="form-control" disabled>
                    </div>

                    {{--price--}}
                    <div class="form-group">
                        <label for="price_hu">Ár:</label>
                        <input type="text" name="price_hu" id="price_hu"
                               value="{{$product->price_hu}}"
                               class="form-control" disabled>
                    </div>

                    {{--payment unit--}}
                    <div class="form-group">
                        <label for="payment_unit">Fizetési egység:</label>
                        <input type="text" name="payment_unit" id="payment_unit" value="{{$product->payment_unit}}"
                               class="form-control" disabled>
                    </div>

                    {{--mode of transport(s)--}}
                    <div class="form-group">
                        <label for="transports">Szállítási mód (több opció is választható):</label>
                        <select name="transports[]" id="transports" class="form-control" multiple disabled>
                            @foreach($transports as $transport)
                                <option value="{{$transport->id}}"
{{--                                    {{$product->id
                                      && $product->modeOfTransports()->pluck('mode_hu')->count()==0
                                      && $transport->id == $product->modeOfTransport->id ? 'selected':''}}--}}
                                    {{old('transports')===null && $product->id && $product->hasModeOfTransport
                                    ($transport->id) ? 'selected':''}}
                                    {{old('transports')!==null && (collect(old('transports'))->contains($transport->id)) ?
                                    'selected':''}}
                                >{{$transport->mode_hu}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{--dates--}}
                    <div class="form-group">
                        Létrehozás dátuma:
                        <input type="text" name="created_at" disabled value="{{$product->created_at}}"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        Módosítás dátuma:
                        <input type="text" name="updated_at" disabled value="{{$product->updated_at}}"
                               class="form-control">
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
