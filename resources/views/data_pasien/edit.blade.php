@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ubah Data Pasien</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('data-pasien.update', $dataPasien->id) }}">
                        @csrf
                        @method('PUT') 

                        <!-- Select2 Dropdown for Data Rumah Sakit -->
                        <div class="mb-3">
                            <label for="rs_id" class="form-label">Data Rumah Sakit</label>
                            <select class="js-example-basic-single form-control" name="rs_id" id="rs_id" required>
                                <option value="">Pilih Rumah Sakit</option>
                                @foreach($data as $rs)
                                    <option value="{{ $rs->id }}" {{ $rs->id == $dataPasien->rs_id ? 'selected' : '' }}>
                                        {{ $rs->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rs_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Pasien -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $dataPasien->nama) }}" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $dataPasien->alamat) }}" required>
                            @error('alamat')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Telepon</label>
                            <input type="number" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp', $dataPasien->no_telp) }}" required>
                            @error('no_telp')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
