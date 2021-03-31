@if(authCustomer())
    Belépve: {{authCustomer()->surname}} {{authCustomer()->forename}}
    <form action="{{route('login.destroy')}}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
        <button type="submit" class="btn btn-primary m-3">Ügyfél kilépés</button>
    </form>
@else
    <a href="{{route('customer.create')}}">Ügyfél regisztráció</a> |
    <a href="{{route('login.create')}}">Ügyfél belépés</a> |
@endif

@if(!auth()->guard('customer')->check())
   {{-- @if(auth()->guard()->check())

        Belépve admin: {{auth()->guard()->user()->name }}
        <form action="{{route('admin.logout')}}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            @csrf
            <button type="submit" class="btn btn-primary m-3">Admin kilépés (5)</button>
        </form>
    @else--}}
        <a href="{{route('admin.login.create')}}">Admin belépés</a> |
    {{--@endif--}}
@endif


