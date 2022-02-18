@extends('layout.admin')

@section('title')
    Dashboard | Menu | Insert
@endsection

@section('page-heading')
    Menu
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
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama :</label>
                            <input type="text" name="name" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password :</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level :</label>
                            <select name="level" id="" class="form-control">
                                <option value="ADMIN">ADMIN</option>
                                <option value="WAITER" selected>WAITER</option>
                                <option value="CASHIER">CASHIER</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-4">
                            Tambah User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
