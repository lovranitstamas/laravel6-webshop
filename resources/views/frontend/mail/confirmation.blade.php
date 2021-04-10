<p>Tisztelt {{$user->surname}} {{$user->forename}}!</p>

<p>Termák neve: {{$product->name_hu}}</p>
<p>Ár: {{$product->price_hu}} {{$product->payment_unit}}/DB</p>
<p>Rendelt darabszám: {{$order->quantity}} DB</p>
<p>Végösszeg: {{$order->total_amount}} FT</p>
