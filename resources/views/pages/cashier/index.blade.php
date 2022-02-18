@extends('layout.admin')

@section('title')
    Dashboard Waiter
@endsection

@section('page-heading')
    Dashboard Cashier
@endsection

@section('content')
<div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Transaksi
                </div>
                <div class="card-body">
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pembeli</th>
                                    <th scope="col">Meja</th>
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
    </div>
@endsection
