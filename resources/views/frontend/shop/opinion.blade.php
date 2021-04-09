@extends('frontend.layout.default-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-5">Értékelés - {{$order->product->name_hu}} nevű termékre</h1>

                @include('frontend.layout.message')

                @if(!$comment)
                    <form action="{{route('visitors.shop.comment.store')}}"
                          method="POST">
                        <div class="box-body">

                            <h4>Vélemény írása</h4>

                            <div class="form-group">
                                <input type="hidden" name="product_id" value="{{$order->product->id}}">
                            </div>

                            @csrf

                            <div class="form-group">
                                <label for="content">Tartalom</label>
                                <textarea name="content" id="content" class="form-control"
                                          cols="20" rows="6">{{old('content')}}</textarea>

                                @if($errors->has('content'))
                                    <p style="color:red">{{ $errors->first('content') }}</p>
                                @endif
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <input type="submit" value="Vélemény elküldése" class="btn btn-primary">
                                </div>
                            </div>

                        </div>
                    </form>
                @else
                    <div class="alert alert-warning" role="alert">
                        Új komment létrehozása elutasítva.
                    </div>
                    <p class="font-weight-bold">Az Ön korábbi kommentje: </p>
                    <p>{{$comment->content}}</p>
                    <p>Bejegyzés dátuma: {{$comment->created_at}}</p>
                @endif

                @if(!$rating)
                    <form action="{{route('visitors.shop.rating.store')}}"
                          method="POST">
                        <div class="box-body">

                            <h4>Értékelés</h4>

                            <div class="form-group">
                                <input type="hidden" name="product_id" value="{{$order->product->id}}">
                            </div>

                            @csrf

                            <div class="form-group">
                                <select name="value" id="value" class="form-control">
                                    <option value="0" {{(!old('value')) ? 'selected': ''}}>Kérem válasszon!</option>
                                    @foreach(range(1,5) as $i)
                                        <option value="{{$i}}" {{old('value')==$i? 'selected': ''}}>{{$i}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('value'))
                                    <p style="color:red">{{ $errors->first('value') }}</p>
                                @endif
                            </div>

                            <div class="box-footer">
                                <div class="form-group">
                                    <input type="submit" value="Értékelés elküldése" class="btn btn-primary">
                                </div>
                            </div>

                        </div>
                    </form>
                @else
                    <div class="alert alert-warning" role="alert">
                        Új értékelés létrehozása elutasítva.
                    </div>
                    <p class="font-weight-bold">Az Ön korábbi értékelés (1-5): </p>
                    <p>{{$rating->value}}</p>
                    <p>Bejegyzés dátuma: {{$rating->created_at}}</p>
                @endif

                <p>
                    <a href="{{route('visitors.shop.orderings')}}"
                       class="btn btn-secondary mt-1">Vissza</a>
                </p>
            </div>
        </div>
    </div>
@endsection
