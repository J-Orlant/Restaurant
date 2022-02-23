@extends('layout.admin')

@section('title')
    Dashboard | Menu | Update
@endsection

@section('page-heading')
    User
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header">
            Tambah User
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
                    <form method="POST" action="{{ route('user.update', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama :</label>
                            <input type="text" name="name" class="form-control" required autofocus value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" class="form-control" required value="{{ $item->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="level">Level :</label>
                            <select name="level" id="level" class="form-control">
                                <option value="{{ $item->level }}" selected>Tidak diganti</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="WAITER">WAITER</option>
                                <option value="CASHIER">CASHIER</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-4">
                            Edit User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
