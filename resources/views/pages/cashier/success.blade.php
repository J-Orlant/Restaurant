@extends('layout.admin')

@section('title')
    Dashboard Cashier
@endsection

@section('page-heading')
    Dashboard Cashier
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        Laporan Transaksi
                        <a href="{{ route('cashier.cetak', $item->nama) }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-download fa-sm text-white-50"></i> Laporan</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="container p-5 text-center">
                        <h2>Restoran Cepat Saji</h2>
                        <p class="">
                            Jl.Cipayung Barat 1 No.10C, Kel.Cipayung, Kec.Cipayung, Kab.DKI Jakarta, Jatim <br>
                            Telp: +6281222822833 || E-Mail: idabagusyoges@gmail.com
                        </p>
                        <hr>
                        <p class="text-left">
                            Nama Pembeli     : {{ $item->nama }}
                        </p>
                        <p p class="text-left">
                            Nama Kasir       : {{ Auth()->user()->name }}
                        </p>
                        <p p class="text-left">
                            Waktu Pembayaran : {{ $item->updated_at }}
                        </p>
                        <p p class="text-left">
                            No Meja          : {{ $item->meja }}
                        </p>
                        <hr>
                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <th>No.</th>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                                @foreach ($pesanan as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->menu->nama_menu }}</td>
                                        <td>{{ $data->jumlah }}</td>
                                        <td>Rp.{{ number_format($data->menu->harga) }}</td>
                                        <td>Rp.{{ number_format($data->menu->harga * $data->jumlah) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4">Total</th>
                                    <td>Rp.{{ number_format($item->total) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Uang Bayar</th>
                                    <td>Rp.{{ number_format($item->bayar) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Uang Kembalian</th>
                                    <td>Rp.{{ number_format(abs($item->total - $item->bayar)) }}</td>
                                </tr>
                            </table>
                        </div>

                        <hr class="mt-5">
                        <h4>
                            Terima Kasih Atas Kunjungan nya
                        </h4>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
