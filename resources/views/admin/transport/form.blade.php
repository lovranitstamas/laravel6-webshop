<form action="{{$transport->id ?
                route('admin.transport.update', $transport->id) :
                route('admin.transport.store')}}"
      method="POST">
    <div class="box-body">
        @if($transport->id)
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                #
                <input type="text" name="id" value="{{$transport->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        <div class="form-group">
            Név:
            <input type="text" name="mode_hu" value="{{old('mode_hu') ?: $transport->mode_hu}}"
                   class="{{$errors->first('mode_hu') ? 'has-error': ''}} form-control">
            @if($errors->first('mode_hu'))
                <p style="color:red">
                    {{$errors->first('mode_hu')}}
                </p>
            @endif
        </div>

        @if($transport->id)
            <div class="form-group">
                Létrehozás dátuma:
                <input type="text" name="created_at" disabled value="{{$transport->created_at}}"
                       class="form-control">
            </div>

            <div class="form-group">
                Módosítás dátuma:
                <input type="text" name="updated_at" disabled value="{{$transport->updated_at}}"
                       class="form-control">
            </div>
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <div class="form-group">
            <input type="submit" value="{{!$transport->id ? 'Létrehozás' : 'Módosítás'}}" class="btn btn-primary">
        </div>
    </div>
</form>
