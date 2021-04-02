<form action="{{$subCategory->id ?
                route('admin.sub_category.update', $subCategory->id) :
                route('admin.sub_category.store')}}"
      method="POST">
    <div class="box-body">
        @if($subCategory->id)
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group">
                #
                <input type="text" name="id" value="{{$subCategory->id}}" disabled class="form-control">
            </div>
        @endif

        @csrf

        <div class="form-group">
            Név:
            <input type="text" name="name_hu" value="{{old('name_hu') ?: $subCategory->name_hu}}"
                   class="{{$errors->first('name_hu') ? 'has-error': ''}} form-control">
            @if($errors->first('name_hu'))
                <p style="color:red">
                    {{$errors->first('name_hu')}}
                </p>
            @endif
        </div>

        <div class="form-group">
            Kategória kiválasztása:
            <select name="category_id" class="form-control">
                <option value="0"
                    {{!$subCategory->category() && !old('category_id')
                      ? 'seelcted':''}}>Kérem
                    válasszon!
                </option>
                @foreach($categories as $category)
                    @if($subCategory->category()->count()==0)
                        <option value="{{$category->id}}"
                            {{$category->id == old('category_id') ? 'selected': ''}}>
                            {{$category->name_hu}}
                        </option>
                    @else
                        <option value="{{$category->id}}"
                            {{$category->id == $subCategory->category->id ? 'selected': ''}}>
                            {{$category->name_hu}}
                        </option>
                    @endif
                @endforeach
            </select>
            @if($errors->first('category_id'))
                <p style="color:red">
                    {{$errors->first('category_id')}}
                </p>
            @endif
        </div>

        @if($subCategory->id)
            <div class="form-group">
                Létrehozás dátuma:
                <input type="text" name="created_at" disabled value="{{$subCategory->created_at}}"
                       class="form-control">
            </div>

            <div class="form-group">
                Módosítás dátuma:
                <input type="text" name="updated_at" disabled value="{{$subCategory->updated_at}}"
                       class="form-control">
            </div>
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <div class="form-group">
            <input type="submit" value="{{!$subCategory->id ? 'Létrehozás' : 'Módosítás'}}" class="btn btn-primary">
        </div>
    </div>
</form>
