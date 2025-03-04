@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ubah Data Rumah Sakit</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('data-rs.update', $data->id) }}">
                            @csrf   
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Rumah Sakit</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $data->nama) }}" required>
                                @error('nama') 
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $data->alamat) }}" required>
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $data->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="number" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp', $data->no_telp) }}" required>
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
