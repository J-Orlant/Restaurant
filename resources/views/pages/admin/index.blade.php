@extends('layout.admin')

@section('title')
    Dashboard
@endsection

@section('page-heading')
    Dashboard
@endsection

@section('content')

    @include('components.content-card')

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    Helo
                </div>
            </div>
        </div>
    </div>
@endsection
