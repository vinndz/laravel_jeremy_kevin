@extends('layouts.layout')

@section('content')
<div class="container-fluid px-4 animate__animated animate__fadeIn">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">Dashboard</h2>
        </div>

        <div class="row justify-content-start mt-4">
            <div class="col-md-12 col-lg-10">
                <div class="row">
                    <div class="col-xl-4 col mb-4 ms-3">
                        <div class="card shadow-sm border-light rounded">
                            <div class="card-body bg-info text-white rounded-top">
                                <h5 class="card-title">Data Rumah Sakit</h5>
                                <p class="card-text" id="dataRSCount">Total data rumah sakit : {{ $dataRS }}</p>
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
                                <p class="card-text" id="dataPasienCount">Total data pasien : {{ $dataPasien }}</p>
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
</div>

@endsection
