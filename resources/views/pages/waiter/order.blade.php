@extends('layout.admin')

@section('title')
    Dashboard Waiter | Order
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
        </style>
    @endpush

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
                            <input type="text" id="nama1" class="form-control" required name="nama1" autofocus onkeyup="saveValue(this)">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="meja">Meja</label>
                            <select type="text" id="meja1" class="form-control" required name="meja1">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <h6 class="mt-2">Menu</h6>
                <!-- Menu -->
                <div class="row">
                    @foreach ($menu as $m)
                        <div class="col-md-4 col-6">
                            <form action="{{ route('waiter-order-action') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nama" id="nama" class="nama" required>
                                <input type="hidden" name="meja" id="meja" class="meja" required>
                                <input type="hidden" name="menu_id" value="{{ $m->id }}" required>
                                <div class="card">
                                    <div class="card-header card-gambar" style="background-image: url('{{ Storage::url($m->gambar) }}')">
                                    </div>
                                    <div class="card-body">
                                        <strong>{{ $m->nama_menu }}</strong> <br>
                                        Rp.{{ $m->harga }}
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <input type="number" class="form-control mr-3" placeholder="Jumlah" name="jumlah" required>
                                            <button class="btn btn-success">Pesan</button>
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
    <script>
        $('.meja').val($('#meja1').val());
        // $('.nama').val($('#nama1').val());

        console.log($('.nama').val());
        console.log($('.meja').val());

        if($('#nama1').val()) {
            console.log($(".nama").val());
        }

        $("#nama1").keyup(function(){
            update();
        });
        $('#meja1').on('change', function() {
            updateChange();
        });

        function update() {
            $(".nama").val($('#nama1').val());
        }
        function updateChange() {
            $('.meja').val($('#meja1').val());
        }

    </script>
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
    <script type="text/javascript">
        document.getElementById("nama1").value = getSavedValue("nama1");    // set the value to this input
        /* Here you can add more inputs to set value. if it's saved */

        //Save the value function - save it to localStorage as (ID, VALUE)
        function saveValue(e){
            var id = e.id;  // get the sender's id to save it .
            var val = e.value; // get the value.
            localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override .
        }

        //get the saved value function - return the value of "v" from localStorage.
        function getSavedValue  (v){
            if (!localStorage.getItem(v)) {
                return "";// You can change this to your defualt value.
            }
            return localStorage.getItem(v);
        }

        $(function() {
            if (localStorage.getItem('meja1')) {
                $("#meja1 option").eq(localStorage.getItem('meja1')).prop('selected', true);
            }

            $("#meja1").on('change', function() {
                    localStorage.setItem('meja1', $('option:selected', this).index());
            });
        });
    </script>
    @endpush
@endsection
