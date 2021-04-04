@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item active">Alkategóriák</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Alkategóriák</h3>

                    <div class="card-tools">
                        <a href="{{route('admin.sub_category.create')}}" class="btn btn-primary">Alkategória
                            létrehozása</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Név</th>
                            <th>Kategória</th>
                            <th>Létrehozás dátuma</th>
                            <th>Módosítás dátuma</th>
                            <th>Megtekintés/Módosítás</th>
                            <th>Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subCategories as $subCategory)
                            <tr>
                                <td>{{$subCategory->id}}</td>
                                <td>{{$subCategory->name_hu}}</td>
                                <td>
                                    {{$subCategory->category->name_hu}}
                                </td>
                                <td>{{$subCategory->created_at}}</td>
                                <td>{{$subCategory->updated_at}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route('admin.sub_category.show', $subCategory->id)}}"
                                           class="btn btn-info btn-sm">Megtekintés</a>
                                        {{--['id' => $category->id]--}}
                                        @if($subCategory->products()->count()==0)
                                            <a href="{{route('admin.sub_category.edit', $subCategory->id)}}"
                                               class="btn btn-default btn-sm">Módosítás</a>
                                        @else
                                            | Tiltás alatt
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($subCategory->products()->count()==0)
                                        <form action="{{route('admin.sub_category.destroy', $subCategory->id)}}"
                                              method="POST">
                                            <input type="hidden" name="_method" value="delete">
                                            @csrf
                                            <input type="submit" name="button" value="Törlés" class="btn btn-danger">
                                        </form>
                                    @else
                                        Tiltás alatt
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if (count($subCategories)==0)
                            <td colspan="7"><h4 class="text-center font-weight-bold">A lista üres</h4></td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop
