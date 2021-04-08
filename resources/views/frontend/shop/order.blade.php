@extends('frontend.layout.default-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-5">Rendelés véglegesítése</h1>
                <h2>{{$product->name_hu}}</h2>

                <form action="{{route('visitors.shop.order.store')}}"
                      method="POST">
                    <div class="box-body">

                        @include('frontend.layout.message')

                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{$product->id}}" class="form-control">
                        </div>

                        @csrf

                        <div class="form-group">
                            <span class="font-weight-bold">Főkép</span>
                            <p>
                                <a href="{{ \Storage::disk('dev')->url($product->avatar_path)}}">
                                    <img src="{{ \Storage::disk('dev')->url($product->avatar_path)}}"
                                         alt="{{$product->avatar}}" width="50">
                                </a>
                            </p>
                        </div>

                        @if(count($product->attachments)>0)
                            <div class="form-group">
                                <span class="font-weight-bold">Egyéb kép(ek)</span><br>
                                @foreach($product->attachments as $attachment)
                                    <a href="{{ $attachment->publicUrl()  }}">
                                        <img src="{{$attachment->publicUrl()}}" alt="picture" width="150">
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            <span class="font-weight-bold">Kategória:</span>
                            {{$product->subCategory->category->name_hu}}
                        </div>

                        <div class="form-group">
                            <span class="font-weight-bold">Alkategória:</span>
                            {{$product->subCategory->name_hu}}
                        </div>

                        <div class="form-group">
                            <span class="font-weight-bold">Darab/Ár:</span>
                            {{$product->price_hu}} {{$product->payment_unit}}
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="price_hu" value="{{$product->price_hu}}">
                        </div>

                        {{--                        <div class="form-group">
                                                    <input type="hidden" name="price_hu" value="{{$product->price_hu}}">
                                                </div>--}}


                        <div class="form-group">
                            Kért darabszám:
                            <input type="text" name="quantity" value="{{old('quantity')}}"
                                   class="{{$errors->first('quantity') ? 'has-error': ''}} form-control">
                            @if($errors->first('quantity'))
                                <p style="color:red">
                                    {{$errors->first('quantity')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="transport_id">Szállítási mód:</label>
                            <select name="transport_id" id="transport_id" class="form-control">
                                <option
                                    {{old('transport_id')===null ? 'selected':''}} value="0"
                                >Kérem válasszon
                                </option>
                                @foreach($product->modeOfTransports as $transport)
                                    <option value="{{$transport->id}}"
                                        {{old('transport_id')!==null &&
                                         old('transport_id')==$transport->id ? 'selected':''}}
                                    >{{$transport->mode_hu}}
                                        @if($transport->extra_cost!=null)
                                            - ({{$transport->extra_cost}} FT)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->first('transport_id'))
                                <p style="color:red">
                                    {{$errors->first('transport_id')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            <a href="{{route('visitors.shop')}}"
                               class="btn btn-secondary mt-1">Vissza</a>
                        </div>

                        <div class="box-footer">
                            <div class="form-group">
                                <input type="submit" value="Rendelés lezárása" class="btn btn-primary">
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
