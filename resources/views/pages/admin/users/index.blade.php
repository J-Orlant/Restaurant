@extends('layout.admin')

@section('title')
    Dashboard | User
@endsection

@section('page-heading')
    Table User
@endsection

@section('content')
    @push('addon-css')
        <link rel="stylesheet" href="{{ asset('plugins/toast/build/toastr.css') }}">
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Menu
                </div>
                <div class="col-md-8">
                    <a href="{{ route('user.create') }}" class="btn btn-primary mt-3">
                        Tambah User
                    </a>
                </div>
                <div class="col-md-12 mt-3 table-responsive">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $da)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $da->name }}</td>
                                <td>{{ $da->email }}</td>
                                <td>{{ $da->level }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $da->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('user.destroy', $da->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $data->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    @push('addon-js')
    <script src="{{ asset('plugins/toast/nuget/content/scripts/toastr.js') }}"></script>
    @if (session()->has('success'))
    <script>
        toastr["success"]("{{ session('success') }}");
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
