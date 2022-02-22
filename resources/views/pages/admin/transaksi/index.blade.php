@extends('layout.admin')

@section('title')
    Dashboard | Transaksi
@endsection

@section('page-heading')
    Table Transaksi
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Transaksi
                </div>
                <div class="col-md-12 mt-3 table-responsive">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Meja</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $data)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->meja }}</td>
                                <td class="{{ ($data->status == 'LUNAS') ? 'text-success' : 'text-damger' }}" >
                                    {{ $data->status }}
                                </td>
                                <td>
                                    <a href="{{ route('transaksi.detail', $data->nama) }}" class="btn btn-primary">
                                        <i class="fas fa-info"></i>
                                    </a>
                                    {{-- <form class="d-inline" action="{{ route('transaksi.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form> --}}
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
