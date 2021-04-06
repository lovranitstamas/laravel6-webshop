@extends('frontend.layout.default-layout')

@section('content')

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1>Tisztelt {{authCustomer()->surname}} {{authCustomer()->forename}}!</h1>

                <h3 class="mt-5">Örülönk, hogy újra itt látjuk Önt.</h3>

            </div>
        </div>
    </div>

@endsection


