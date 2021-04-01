@extends('admin.layout.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kategóriák</h3>

                    <div class="card-tools">
                        <a href="{{route('admin.category.create')}}" class="btn btn-primary">Kategória létrehozása</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Név</th>
                            <th>Létrehozás dátuma</th>
                            <th>Módosítás dátuma</th>
                            <th>Megtekintés/Módosítás</th>
                            <th>Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name_hu}}</td>
                                <td>{{$category->created_at}}</td>
                                <td>{{$category->updated_at}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route('admin.category.show', $category->id)}}"
                                           class="btn btn-info btn-sm">Megtekintés</a>
                                        {{--['id' => $category->id]--}}
                                        <a href="{{route('admin.category.edit', $category->id)}}"
                                           class="btn btn-default btn-sm">Módosítás</a>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{route('admin.category.destroy', $category->id)}}" method="POST">
                                        <input type="hidden" name="_method" value="delete">
                                        @csrf
                                        <input type="submit" name="button" value="Törlés" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($categories)==0)
                            <td colspan="5"><h4 class="text-center font-weight-bold">A lista üres</h4></td>
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
