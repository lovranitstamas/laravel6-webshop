@extends('frontend.layout.default-layout')

@section('content')

    <h1>Tisztelt {{authCustomer()->surname}} {{authCustomer()->forename}}!</h1>

    <h3>Örülönk, hogy újra itt látjuk Önt.</h3>

@endsection


