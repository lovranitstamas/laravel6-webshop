<form action="{{$product->id ?
                route('admin.product.update', $product->id) :
                route('admin.product.store')}}"
      enctype="multipart/form-data"
      method="POST">
    <div class="box-body">
        {{--id--}}
        @if($product->id)
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                <label for="id">#</label>
                <input type="text" name="id" id="id" value="{{$product->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        {{--name--}}
        <div class="form-group">
            <label for="name_hu">Termék neve:</label>
            <input type="text" name="name_hu" id="name_hu" value="{{old('name_hu') ?: $product->name_hu}}"
                   class="{{$errors->first('name_hu') ? 'has-error': ''}} form-control">
            @if($errors->first('name_hu'))
                <p style="color:red">
                    {{$errors->first('name_hu')}}
                </p>
            @endif
        </div>

        {{--avatar--}}
        @if($product->id)
            <div class="form-group">
                <span class="font-weight-bold">Avatar kép</span><br>
                <a href="{{ \Storage::disk('dev')->url($product->avatar_path)}}">
                    <img src="{{ \Storage::disk('dev')->url($product->avatar_path)}}"
                         alt="{{$product->avatar}}" width="50">
                </a><br>
                <a href="{{route('admin.avatar.download',
                                        [ 'path'  =>  $product->avatar_path,
                                          'name'  =>  $product->avatar
                                          ])}}">Letöltés</a>
            </div>
        @endif

        {{--other attachments--}}
        @if(count($product->attachments)>0)
            <div class="form-group">
                <span class="font-weight-bold">Egyéb kép(ek)</span><br>
                @foreach($product->attachments as $attachment)
                    <a href="{{ $attachment->publicUrl()  }}">
                        <img src="{{$attachment->publicUrl()}}" alt="picture" width="70">
                    </a>
                @endforeach
            </div>
        @endif

        {{--(sub) category--}}
        <div class="form-group">
            <label for="sub_category_id">Kategória kiválasztása:</label>
            <select name="sub_category_id" id="sub_category_id" class="form-control">
                <option value="0"
                    {{!$product->subCategory() && !old('sub_category_id')
                      ? 'selected':''}}>Kérem válasszon!
                </option>
                @foreach($subCategories as $subCategory)
                    @if($product->subCategory()->count()==0)
                        <option value="{{$subCategory->id}}"
                            {{$subCategory->id == old('sub_category_id') ? 'selected': ''}}>
                            {{$subCategory->category->name_hu}} - {{$subCategory->name_hu}}
                        </option>
                    @else
                        <option value="{{$subCategory->id}}"
                            {{$product->subCategory->id == $subCategory->category->id ? 'selected': ''}}>
                            {{$subCategory->category->name_hu}} - {{$subCategory->name_hu}}
                        </option>
                    @endif
                @endforeach
            </select>
            @if($errors->first('sub_category_id'))
                <p style="color:red">
                    {{$errors->first('sub_category_id')}}
                </p>
            @endif
        </div>

        {{--state--}}
        <div class="form-group">
            <label for="state">Státusz:</label>
            <select name="state" id="state" class="form-control">
                <option value="-1" {{(!$product->state && !old('state')) || old('state')==-1 ? 'selected':''}}>Kérem
                    válasszon!
                </option>
                @if($product->id && old('state')===null)
                    <option value="1" {{$product->state==1 ? 'selected':''}}>Aktív</option>
                    <option value="0" {{$product->state==0 ? 'selected':''}}>Inaktív</option>
                @else
                    <option value="1" {{old('state')!==null && old('state')==1 ? 'selected':''}}>Aktív</option>
                    <option value="0" {{old('state')!==null && old('state')==0 ? 'selected':''}}>Inaktív</option>
                @endif
            </select>
            @if($errors->first('state'))
                <p style="color:red">
                    {{$errors->first('state')}}
                </p>
            @endif
        </div>

        {{--inventory--}}
        <div class="form-group">
            <label for="inventory">Raktárkészlet (db):</label>
            <input type="text" name="inventory" id="inventory" value="{{old('inventory') ?: $product->inventory}}"
                   class="{{$errors->first('inventory') ? 'has-error': ''}} form-control">
            @if($errors->first('inventory'))
                <p style="color:red">
                    {{$errors->first('inventory')}}
                </p>
            @endif
        </div>

        {{--price--}}
        <div class="form-group">
            <label for="price_hu">Ár:</label>
            <input type="text" name="price_hu" id="price_hu" value="{{old('price_hu') ?: $product->price_hu}}"
                   class="{{$errors->first('price_hu') ? 'has-error': ''}} form-control">
            @if($errors->first('price_hu'))
                <p style="color:red">
                    {{$errors->first('price_hu')}}
                </p>
            @endif
        </div>

        {{--payment unit--}}
        <div class="form-group">
            <label for="payment_unit">Fizetési egység:</label>
            <input type="text" name="payment_unit" id="payment_unit" value="{{old('payment_unit') ?:
            $product->payment_unit}}"
                   class="{{$errors->first('payment_unit') ? 'has-error': ''}} form-control">
            @if($errors->first('payment_unit'))
                <p style="color:red">
                    {{$errors->first('payment_unit')}}
                </p>
            @endif
        </div>

        {{--mode of transport(s)--}}
        <div class="form-group">
            <label for="transports">Szállítási mód (több opció is választható):</label>
            <select name="transports[]" id="transports" class="form-control" multiple>
                @foreach($transports as $transport)
                    <option value="{{$transport->id}}"
                          {{--$product->id
                          && $product->modeOfTransports()->pluck('mode_hu')->count()==0
                          && $transport->id == $product->modeOfTransport->id ? 'selected':''--}}
                        {{old('transports')===null && $product->id && $product->hasModeOfTransport($transport->id) ?
                        'selected':''}}
                        {{old('transports')!==null && (collect(old('transports'))->contains($transport->id)) ?
                        'selected':''}}
                    >{{$transport->mode_hu}}
                    </option>
                @endforeach
            </select>
            @if($errors->first('transports'))
                <p style="color:red">
                    {{$errors->first('transports')}}
                </p>
            @endif
        </div>

        {{--main attachment--}}
        <div class="form-group {{$errors->first('avatar') ? 'has-error': ''}}">
            <label for="mainInputFile">Fő kép</label>
            <input type="file" name="avatar" id="mainInputFile" class="form-control">

            @if($errors->first('avatar'))
                <p style="color:red">{{$errors->first('avatar')}}</p>
            @endif
        </div>

        {{--other attachment(s)--}}
        <div class="form-group {{$errors->first('other_attachments') ? 'has-error': ''}}">
            <label for="otherInputFile">Egyéb kép(ek). Maximum 5 db</label>
            <input type="file" name="other_attachments[]" multiple id="otherInputFile" class="form-control">

            @if($errors->has('other_attachments.*'))
                <p style="color:red">{{ $errors->first('other_attachments.*') }}</p>
            @endif
        </div>

        {{--dates--}}
        @if($product->id)
            <div class="form-group">
                Létrehozás dátuma:
                <input type="text" name="created_at" disabled value="{{$product->created_at}}"
                       class="form-control">
            </div>

            <div class="form-group">
                Módosítás dátuma:
                <input type="text" name="updated_at" disabled value="{{$product->updated_at}}"
                       class="form-control">
            </div>
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <div class="form-group">
            <input type="submit" value="{{!$product->id ? 'Indít' : 'Módosítás'}}" class="btn btn-primary">
        </div>
    </div>
</form>
