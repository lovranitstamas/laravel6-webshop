@extends('frontend.layout.default-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">

                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fas fa-check"></i></h4>
                        {{session('success')}}
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fas fa-ban"></i>Hiba!</h4>
                        {{session('error')}}
                    </div>
                @endif

                <h3 class="mt-5">Profil</h3>

                <form action="{{route('customer.update')}}" method="POST" class="mt-3">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf

                    <div class="form-group">
                        Email:
                        <input type="text" name="email" value="{{old('email')?:$user->email}}" class="form-control">
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
                        <input type="text" name="surname" value="{{old('surname')?:$user->surname}}"
                               class="form-control">
                        @if($errors->first('surname'))
                            <p style="color:red">
                                {{$errors->first('surname')}}
                            </p>
                        @endif
                    </div>

                    <div class="form-group">
                        Keresztnév:
                        <input type="text" name="forename" value="{{old('forename')?:$user->forename}}"
                               class="form-control">
                        @if($errors->first('forename'))
                            <p style="color:red">
                                {{$errors->first('forename')}}
                            </p>
                        @endif
                    </div>

                    <div class="form-group">
                        Irányítószám:
                        <input type="text" name="zipcode" value="{{old('zipcode')?:$user->zipcode}}"
                               class="form-control">
                        @if($errors->first('zipcode'))
                            <p style="color:red">
                                {{$errors->first('zipcode')}}
                            </p>
                        @endif
                    </div>

                    <div class="form-group">
                        Város:
                        <input type="text" name="city" value="{{old('city')?:$user->city}}" class="form-control">
                        @if($errors->first('city'))
                            <p style="color:red">
                                {{$errors->first('city')}}
                            </p>
                        @endif
                    </div>

                    <div class="form-group">
                        Utca, házszám:
                        <input type="text" name="address" value="{{old('address')?:$user->address}}"
                               class="form-control">
                        @if($errors->first('address'))
                            <p style="color:red">
                                {{$errors->first('address')}}
                            </p>
                        @endif
                    </div>

                    <div class="form-group">
                        Telefonszám:
                        <input type="text" name="phone" value="{{old('phone')?:$user->phone}}" class="form-control">
                        @if($errors->first('phone'))
                            <p style="color:red">
                                {{$errors->first('phone')}}
                            </p>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Módosítás" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop

