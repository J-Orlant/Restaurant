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
                                    @foreach ($meja as $m)
                                        <option value="{{ $m->id }}"
                                            @if ($m->status == 0)
                                                disabled
                                            @endif
                                            class = "{{ ($m->status == 0) ? 'text-danger' : 'text-success' }}"
                                            >
                                            {{ $m->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-3">
                        1
                    </div>
                    <div class="col-md-3">
                        2
                    </div>
                </div> --}}
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
