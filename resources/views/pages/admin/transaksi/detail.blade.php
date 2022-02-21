@extends('layout.admin')

@section('title')
    Dashboard Waiter | Detail Pesanan
@endsection

@section('page-heading')
    Detail Pesanan
@endsection

@section('content')
    @push('addon-css')
        <style>
            .image {
                width: 80px;
                height: 80px;
                border-radius: 10px;

                background-size: cover;
                background-position: center;
            }

            .nama-menu {
                font-size: 20px;
                text-overflow: ellipsis;
            }

            .jumlah {
                font-size: 20px;
                font-weight: bolder;
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        Detail Pesanan
                        <div>
                            <button class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ $item->nama }} | Meja {{ $item->meja }}</h5>
                    </div>
                    <hr>
                    <h4>List Menu</h4>
                    <ul class=" list-group list-group-flush mt-3 table-responsive">
                        @foreach ($pesanan as $p)
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="image" style="background-image: url('{{ Storage::url($p->menu->gambar) }}')"></div>
                                    <div class="ml-3 mr-5">
                                        <strong class="nama-menu">{{ $p->menu->nama_menu }}</strong> <br>
                                        Rp.{{ number_format($p->menu->harga) }}
                                    </div>
                                    x{{ $p->jumlah }}
                                </div>
                                <p class="jumlah"> Rp.{{ number_format($p->total) }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card shadow">
                <div class="card-header">
                    Rincian
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Total</strong>
                        <div class="d-flex">
                            Rp.
                            <p id="total">
                                {{ $total }}
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('cashier.transaksi', $item->nama) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong>Bayar</strong>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="bayar" name="bayar" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Kembalian</strong>
                            <p id="kembalian"></p>
                        </div>
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-success" id="button">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('addon-js')
        <script>
            var total = document.getElementById('total');
            var bayar = document.getElementById('bayar');
            var kembalian = document.getElementById('kembalian');
            var hasil = 0;

            var button = document.getElementById('button');
            button.disabled = true;

            if(kembalian.innerHTML == '') {
                kembalian.innerHTML = "Rp.-";
            }

            bayar.addEventListener('keyup', function() {
                hasil = total.innerHTML - bayar.value;
                if(hasil <= 0) {
                    kembalian.innerHTML = "Rp." + hasil;
                    button.disabled = false;
                }
            });
        </script>
    @endpush
@endsection
