@extends('frontend.layout.default-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <h4 class="mt-5">Regisztráció</h4>

                @if(session()->has('message'))
                    <h3>{{session('message')}}</h3>
                @else
                    <form action="{{route('customer.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            Email:
                            <input type="text" name="email" value="{{old('email')}}" class="form-control">
                            @if($errors->first('email'))
                                <p style="color:red">
                                    {{$errors->first('email')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            Jelszó:
                            <input type="password" name="password" class="form-control">
                            @if($errors->first('password'))
                                <p style="color:red">
                                    {{$errors->first('password')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            Jelszó újra:
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="form-group">
                            Vezetéknév:
                            <input type="text" name="surname" value="{{old('surname')}}" class="form-control">
                            @if($errors->first('surname'))
                                <p style="color:red">
                                    {{$errors->first('surname')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            Keresztnév:
                            <input type="text" name="forename" value="{{old('forename')}}" class="form-control">
                            @if($errors->first('forename'))
                                <p style="color:red">
                                    {{$errors->first('forename')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            Irányítószám:
                            <input type="text" name="zipcode" value="{{old('zipcode')}}" class="form-control">
                            @if($errors->first('zipcode'))
                                <p style="color:red">
                                    {{$errors->first('zipcode')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            Város:
                            <input type="text" name="city" value="{{old('city')}}" class="form-control">
                            @if($errors->first('city'))
                                <p style="color:red">
                                    {{$errors->first('city')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            Utca, házszám:
                            <input type="text" name="address" value="{{old('address')}}" class="form-control">
                            @if($errors->first('address'))
                                <p style="color:red">
                                    {{$errors->first('address')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            Telefonszám:
                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                            @if($errors->first('phone'))
                                <p style="color:red">
                                    {{$errors->first('phone')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="terms" value="1" {{old('terms') ? 'checked': ''}}>
                                Elfogadok mindent
                            </label>
                            @if($errors->first('terms'))
                                <p style="color:red">
                                    {{$errors->first('terms')}}
                                </p>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Regisztráció" class="btn btn-primary">
                        </div>

                    </form>

                @endif
            </div>
        </div>
    </div>
@stop
