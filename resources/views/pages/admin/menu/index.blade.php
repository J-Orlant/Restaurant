@extends('layout.admin')

@section('title')
    Dashboard | Menu
@endsection

@section('page-heading')
    Table Menu
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Menu
                </div>
                <div class="col-md-8">
                    <a href="{{ route('menu.create') }}" class="btn btn-primary mt-3">
                        Tambah Menu
                    </a>
                </div>
                <div class="col-md-12 mt-3">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $d)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $d->nama_menu }}</td>
                                <td>{{ $d->harga }}</td>
                                <td>
                                    <img src="{{ Storage::url($d->gambar); }}" width="100px" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('menu.edit', $d->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('menu.destroy', $d->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
