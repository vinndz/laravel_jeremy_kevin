@extends('layouts.layout')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="row">

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <div class="card-body bg-info text-white rounded-top">
                            <h5 class="card-title">Data Rumah Sakit</h5>
                            <p class="card-text">Kelola data rumah sakit dengan mudah.</p>
                        </div>
                        <div class="card-footer bg-info d-flex align-items-center justify-content-between rounded-bottom">
                            <a class="small text-white stretched-link" href="{{ route('data-rs.index') }}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <div class="card-body bg-success text-white rounded-top">
                            <h5 class="card-title">Data Pasien</h5>
                            <p class="card-text">Kelola data pasien dengan cepat dan efisien.</p>
                        </div>
                        <div class="card-footer bg-success d-flex align-items-center justify-content-between rounded-bottom">
                            <a class="small text-white stretched-link" href="{{ route('data-pasien.index') }}">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
