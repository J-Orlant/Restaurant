@extends('layout.admin')

@section('title')
    Dashboard | Meja
@endsection

@section('page-heading')
    Table Meja
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Meja
                </div>
                <div class="col-md-8">
                    <form action="{{ route('meja.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3">
                            Tambah Meja
                        </button>
                    </form>
                </div>
                <div class="col-md-12 mt-3 table-responsive">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                            <th scope="col">Meja</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($meja as $m)
                                <tr>
                                    <td scope="row">{{ $m->id }}</td>
                                    @if ($m->status == 1)
                                        <td class="text-success">
                                            TERSEDIA
                                        </td>
                                        @else
                                        <td class="text-danger">
                                            DITEMPATI
                                        </td>
                                    @endif
                                    <td>
                                        <form action="{{ route('meja.update', $m->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
