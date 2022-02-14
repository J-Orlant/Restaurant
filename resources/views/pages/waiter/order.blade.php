@extends('layout.admin')

@section('title')
    Dashboard Waiter | Order
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                Order
            </div>
            <div class="card-body">
            <form action="{{ route('waiter-order-action') }}" method="POST">
                @csrf
                <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nama">Nama Pemesan</label>
                                <input type="text" id="nama" class="form-control" required name="nama" autofocus onkeyup="saveValue(this)">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="meja">Meja</label>
                                <select type="text" id="meja" class="form-control" required name="meja">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-success">
                            Lanjut
                        </button>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
@endsection
