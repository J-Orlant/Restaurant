@extends('layout.admin')

@section('title')
    Dashboard | Detail Transaksi
@endsection

@section('page-heading')
    Detail Transaksi
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Detail Transaksi
                </div>
                <div class="card-body">
                    <h5>Nama Pembeli : Yogesvara</h5>
                    <h5 class="mt-3">Menu</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-items">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="row">
                                    <img src="/assets/image/1643282625903.png" width="100" height="100" alt="">
                                    <div class="ml-3">
                                        <strong>Pisang</strong><br>
                                        20.0000
                                    </div>
                                </div>
                                <h6>X2</h6>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
