@extends('frontend.layout.default-layout')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3>{{$product->name_hu}}</h3>
                    </div>
                    <div class="box-body">

                        {{--other attachments--}}
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
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
