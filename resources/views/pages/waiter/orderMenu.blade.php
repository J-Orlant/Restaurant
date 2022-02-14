@extends('layout.admin')

@section('title')
    Dashboard Waiter | Order | Menu
@endsection

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('plugins/toast/build/toastr.css') }}">
        <style>
            .card-gambar {
                background-position: center;
                background-size: cover;
                height: 150px;
                width: 100%;
            }

            .cart-image {
                background-position: center;
                background-size: cover;
                height: 60px;
                width: 60px;
                border-radius: 10px;
            }

            .cls {
                top: 0;
                right: 0;
            }
            .cls .close {
                width: 30px;
                height: 30px;
                background-color: black !important;
                border-radius: 30px;

                color: white;
            }
        </style>
    @endpush

    @if (session()->has('cart'))
        <div class="col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Keranjang
                        <div class="row">
                            <!-- TODO:Function tambah pesan -->
                            <form action="{{ route('cart.insert', session('nama')) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">
                                    + Tambah Pesanan
                                </button>
                            </form>
                            <a href="{{ route('cart.batal') }}" class="btn btn-danger ml-2">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($cart as $key => $cart)
                        <div class="col-md-4 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="cart-image" style="background-image: url('{{ Storage::url($cart['gambar']) }}')">
                                        </div>
                                        <div>
                                            <strong class="">{{ $cart['nama_menu'] }}</strong><br>
                                            Rp.{{ $cart['harga'] }}
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <strong class="mr-3">X</strong>
                                            <input type="number" class="form-control" style="width: 50px" value="{{ $cart['jumlah'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute cls">
                                <form action="{{ route('cart.delete', $key) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                Order
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nama">Nama Pemesan</label>
                            <input type="text" id="nama1" class="form-control" required name="nama1" value="{{ session('nama') }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="meja">Meja</label>
                            <select type="text" id="meja1" class="form-control" required name="meja1">
                                <option value="{{ session('meja') }}" disabled selected>{{ session('meja') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h6 class="mt-2">Menu</h6>
                <!-- Menu -->
                <div class="row">
                    @foreach ($menu as $m)
                        <div class="col-md-4 col-6 mb-3">
                            <form action="{{ route('waiter-order-menu-action', $m->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="nama" id="nama" value="{{ session('nama') }}" class="nama" required>
                                <input type="hidden" name="meja" id="meja" value="{{ session('meja') }}" class="meja" required>
                                {{-- <input type="hidden" name="menu_id" value="{{ $m->id }}" required> --}}
                                <div class="card">
                                    <div class="card-header card-gambar" style="background-image: url('{{ Storage::url($m->gambar) }}')">
                                    </div>
                                    <div class="card-body">
                                        <strong>{{ $m->nama_menu }}</strong> <br>
                                        Rp.{{ $m->harga }}
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <input type="number" class="form-control mr-3" placeholder="Jumlah" name="jumlah" required>
                                            <!-- TODO:Disabled Button -->
                                            <button class="btn btn-success" @if (isset($cart[$m->menu_id]))
                                                disabled
                                            @endif>Pesan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('addon-js')
    <script src="{{ asset('plugins/toast/nuget/content/scripts/toastr.js') }}"></script>
    @if (session()->has('success'))
    <script>
        toastr["success"]("Menu berhasil dipesan!");
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    @endif
    @endpush
@endsection
