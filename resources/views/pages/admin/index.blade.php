@extends('layout.admin')

@section('title')
    Dashboard
@endsection

@section('page-heading')
    Dashboard
@endsection

@section('content')

    @include('components.content-card')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        Laporan
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Laporan</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <input type="date" name="waktu" class="form-control" id="">
                            </div>
                            <div class="col-md-3 text-lg-left text-sm-right">
                                <button type="submit" class="btn btn-primary">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Tabel -->
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Jumlah Terjual</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $d)
                                    <tr>
                                        <td class="text">{{ $key + 1 }}</td>
                                        <td class="text">{{ $d->menu->nama_menu }}</td>
                                        <td class="text">{{ $d->jumlah }}</td>
                                        <td class="text">Rp.{{ number_format($d->menu->harga) }}</td>
                                        <td class="text">Rp.{{ number_format($d->jumlah * $d->menu->harga) }}</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <th class="text-center bg-light" colspan="4">Total Pemasukkan</th>
                                        <th class="text-primary">Rp.{{ number_format($total) }}</th>
                                    </tr>
                            </tbody>
                        </table>
                        {{-- {{ $data->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
