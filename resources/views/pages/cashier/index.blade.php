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
                    Transaksi Baru
                </div>
                <div class="card-body">
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
                                @if (count($transactions) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <strong>Belum ada Transaksi</strong>
                                            <hr>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($transactions as $item => $transaction)
                                    <tr>
                                        <td>{{ $item + 1 }}</td>
                                        <td>{{ $transaction->nama }}</td>
                                        <td>{{ $transaction->meja }}</td>
                                        <td class="text-danger">{{ $transaction->status }}</td>
                                        <td>
                                            <a href="{{ route('cashier.detail', $transaction->nama) }}" class="btn btn-primary">
                                                <i class="fas fa-info"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card shadow">
                <div class="card-header">
                    History Transaksi
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboardCashier') }}" method="POST">
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
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pembeli</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($history) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <strong>Belum ada Transaksi</strong>
                                            <hr>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($history as $item => $h)
                                    <tr>
                                        <td>{{ $item + 1 }}</td>
                                        <td>{{ $h->nama }}</td>
                                        <td>Rp.{{ number_format($h->total) }}</td>
                                        <td class="text-success">{{ $h->status }}</td>
                                        <td>
                                            <a target="_blank" href="{{ route('cashier.cetak', $h->nama) }}" class="btn btn-primary">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $history->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
