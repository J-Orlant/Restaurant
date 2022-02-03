@extends('layout.admin')

@section('title')
    Dashboard | Menu | Update
@endsection

@section('page-heading')
    Menu
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Edit Menu
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
                            <form method="POST" action="{{ route('menu.update', $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama">Nama Menu :</label>
                                    <input type="text" name="nama_menu" value="{{ $data->nama_menu }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Harga :</label>
                                    <input type="number" name="harga" value="{{ $data->harga }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Gambar :</label>
                                    <input type="file" name="gambar" value="{{ $data->gambar }}" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-success mt-4">
                                    Tambah Menu
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
