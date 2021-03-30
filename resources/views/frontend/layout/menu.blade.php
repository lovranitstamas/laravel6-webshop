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


