@extends('admin.layout.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Alkategória megtekintése</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        Név:
                        <input type="text" name="name_hu" value="{{$subCategory->name_hu}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        Kategória:
                        <select name="category_id" class="form-control" disabled>
                            <option value="" selected>Kérem válasszon!</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    {{$category->id==$subCategory->category->id ? 'selected': ''}}>
                                    {{$category->name_hu}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        Létrehozás dátuma:
                        <input type="text" name="created_at" value="{{$subCategory->created_at}}" disabled
                               class="form-control">
                    </div>

                    <div class="form-group">
                        Módosítás dátuma:
                        <input type="text" name="updated_at" value="{{$subCategory->updated_at}}" disabled
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
