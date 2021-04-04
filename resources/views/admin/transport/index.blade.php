@extends('admin.layout.layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kezdőlap</a></li>
    <li class="breadcrumb-item active">Szállítási módok</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Szállítási módok</h3>

                    <div class="card-tools">
                        <a href="{{route('admin.transport.create')}}" class="btn btn-primary">Szállítási mód
                            létrehozása</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Mód neve</th>
                            <th>Létrehozás dátuma</th>
                            <th>Módosítás dátuma</th>
                            <th>Megtekintés/Módosítás</th>
                            <th>Törlés</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transports as $transport)
                            <tr>
                                <td>{{$transport->id}}</td>
                                <td>{{$transport->mode_hu}}</td>
                                <td>{{$transport->created_at}}</td>
                                <td>{{$transport->updated_at}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route('admin.transport.show', $transport->id)}}"
                                           class="btn btn-info btn-sm">Megtekintés</a>
                                        {{--['id' => $category->id]--}}
                                        @if(/*$transport->product()->count()==0 &&*/
                                            $transport->products()->pluck('name_hu')->count()==0)
                                            <a href="{{route('admin.transport.edit', $transport->id)}}"
                                               class="btn btn-default btn-sm">Módosítás</a>
                                        @else
                                            | Tiltás alatt
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if(/*$transport->product()->count()==0  &&*/
                                            $transport->products()->pluck('name_hu')->count()==0 )
                                        <form action="{{route('admin.transport.destroy', $transport->id)}}"
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
                        @if (count($transports)==0)
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
