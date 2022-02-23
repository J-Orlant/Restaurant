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
                font-size: 15px;
                font-weight: bolder;
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Detail Pesanan
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>{{ $item->nama }} | Meja {{ $item->meja }}</h5>
                        <form action="{{ route('pesanan-confirm', $item->nama) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success">Konfirmasi</button>
                        </form>
                    </div>
                    <hr>
                    <h4><strong>List Menu</strong></h4>
                    <ul class=" list-group list-group-flush mt-3 table-responsive">
                        @foreach ($pesanan as $item)
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="image" style="background-image: url('{{ Storage::url($item->menu->gambar) }}')"></div>
                                    <div class="ml-3 mr-5">
                                        <strong class="nama-menu">{{ $item->menu->nama_menu }}</strong> <br>
                                        Rp.{{ number_format($item->menu->harga) }}
                                    </div>
                                </div>
                                <p class="jumlah">x{{ $item->jumlah }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
