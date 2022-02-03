@extends('layout.admin')

@section('title')
    Dashboard | Transaksi | Update
@endsection

@section('page-heading')
    Transaksi
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header">
            Edit Transaksi
        </div>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-4">
                    @if ($errors->any())
                        <div class="container alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Menu :</label>
                            <select name="menu_id" class="custom-select" id="">
                                <option value="{{ $namaMenu->id }}" disabled selected>{{ $namaMenu->nama_menu }}</option>
                                @foreach ($menu as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_menu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Pembeli :</label>
                            <input type="text" name="nama" class="form-control" required value="{{ $pesanan->nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama">Meja :</label>
                            <input type="text" name="meja" class="form-control" required value="{{ $pesanan->meja }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Jumlah :</label>
                            <input type="number" name="jumlah" class="form-control" required value="{{ $pesanan->jumlah }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Total :</label>
                            <input type="number" name="total" class="form-control" required value="{{ $item->total }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama">Bayar :</label>
                            <input type="number" name="bayar" class="form-control" required value="{{ $item->bayar }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Status :</label>
                            <select name="status" class="custom-select" id="">
                                <option value="{{ $item->status }}" selected disabled>{{ $item->status }}</option>
                                <option value="TERTUNDA">TERTUNDA</option>
                                <option value="LUNAS">LUNAS</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-4">
                            Tambah Menu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
