@extends('layout.admin')

@section('title')
    Dashboard Waiter
@endsection

@section('page-heading')
    Dashboard Waiter
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Pesanan
                </div>
                <div class="card-body">
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Pembeli</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Status</th>
                                <th scope="col">Konfirmasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pesanan) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <strong>Belum ada pesanan</strong>
                                            <hr>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($pesanan as $key => $data)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $data->menu->nama_menu }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->meja }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td class="@if ($data->status == 'DIBUAT')
                                        text-warning
                                        @endif">{{ $data->status }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('pesanan-waiter', $data->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pesanan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
