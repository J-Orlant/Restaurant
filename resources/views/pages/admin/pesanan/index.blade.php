@extends('layout.admin')

@section('title')
    Dashboard | Pesanan
@endsection

@section('page-heading')
    Table Pesanan
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Menu
                </div>
                <div class="col-md-8">
                    <a href="{{ route('pesanan.create') }}" class="btn btn-primary mt-3">
                        Tambah Pesanan
                    </a>
                </div>
                <div class="col-md-12 mt-3 table-responsive">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Menu</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Meja</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($query as $key => $que)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $que->menu->nama_menu }}</td>
                                <td>{{ $que->nama }}</td>
                                <td>{{ $que->meja }}</td>
                                <td>{{ $que->jumlah }}</td>
                                <td>
                                    <a href="{{ route('pesanan.edit', $que->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('pesanan.destroy', $que->id) }}" method="post">
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
                    {{-- {{ $data->links() }} --}}
                </div>
            </div>
        </div>
    </div>

@endsection
