@extends('layout.admin')

@section('title')
    Dashboard Waiter
@endsection

@section('page-heading')
    Dashboard Waiter
@endsection

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('plugins/toast/build/toastr.css') }}">
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Pesanan
                </div>
                <div class="card-body">
                    <div class="col-md-12 mt-3 table-responsive">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pembeli</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pesanan) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <strong>Belum ada pesanan</strong>
                                            <hr>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($pesanan as $key => $data)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $data->transaksi->nama }}</td>
                                    <td>{{ $data->transaksi->meja }}</td>
                                        <td class="@if ($data->status == 'DIBUAT')
                                        text-warning
                                        @endif">{{ $data->status }}</td>
                                    <td>
                                        <a href="{{ route('pesanan-detail', [$data->transaksi->nama, $data->transaksi->meja]) }}" type="submit" class="btn btn-primary">
                                            <i class="fas fa-info"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pesanan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('addon-js')
    <script src="{{ asset('plugins/toast/nuget/content/scripts/toastr.js') }}"></script>
    @if (session()->has('success'))
    <script>
        toastr["success"]("Pesanan baru telah masuk!");
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
