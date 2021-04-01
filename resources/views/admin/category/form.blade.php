<form action="{{$category->id ?
                route('admin.category.update', $category->id) :
                route('admin.category.store')}}"
      method="POST">
    <div class="box-body">
        @if($category->id)
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                #
                <input type="text" name="id" value="{{$category->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        <div class="form-group">
            Név:
            <input type="text" name="name_hu" value="{{old('name_hu') ?: $category->name_hu}}"
                   class="{{$errors->first('name_hu') ? 'has-error': ''}} form-control">
            @if($errors->first('name_hu'))
                <p style="color:red">
                    {{$errors->first('name_hu')}}
                </p>
            @endif
        </div>

        @if($category->id)
            <div class="form-group">
                Létrehozás dátuma:
                <input type="text" name="created_at" disabled value="{{$category->created_at}}"
                       class="form-control">
            </div>

            <div class="form-group">
                Módosítás dátuma:
                <input type="text" name="updated_at" disabled value="{{$category->updated_at}}"
                       class="form-control">
            </div>
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <div class="form-group">
            <input type="submit" value="{{!$category->id ? 'Létrehozás' : 'Módosítás'}}" class="btn btn-primary">
        </div>
    </div>
</form>
