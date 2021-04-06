@extends('frontend.layout.default-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="mt-5">Belépés</h4>
                <form action="{{route('login.store')}}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        Email:
                        <input type="text" name="email" value="{{old('email')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        Jelszó:
                        <input type="password" name="password" class="form-control">
                        <br><br>
                        <button type="submit" class="btn btn-primary">Belépés</button>
                    </div>

                    @if (count($errors))
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </form>
            </div>
        </div>
    </div>

@stop
