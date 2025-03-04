@extends('layouts.layout')


@section('content')

<div class="content">
    <div class="card shadow-lg">
        <div class="card-header">
            <h2 class="mb-0">Data Pasien</h2>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('data-pasien.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> Tambah Data
                </a>
            </div>

            <div class="table-responsive" style="max-height: 500px; overflow: auto;">
                <table class="table table-hover table-bordered animate__animated animate__fadeIn" id="table" width="100%">
                    <thead class="table-light">
                        <tr>
                            <th style="color: black;">{{ ucwords('no') }}</th>
                            <th style="color: black;">{{ ucwords('nama rumah sakit') }}</th>
                            <th style="color: black;">{{ ucwords('nama pasien') }}</th>
                            <th style="color: black;">{{ ucwords('alamat') }}</th>
                            <th style="color: black;">{{ ucwords('nomor telepon') }}</th>
                            <th style="color: black;">{{ ucwords('aksi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data-pasien.data') }}", 
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                dataSrc: function(json) {
                    // untuk debug
                    console.log(json);  
                    return json.aaData; 
                }
            },
            columns: [
                { data: 'id', orderable: false },
                { data: 'nama_rs', name: 'nama_rs' },
                { data: 'nama_pasien', name: 'nama_pasien' },
                { data: 'alamat', name: 'alamat' },
                { data: 'no_telp', name: 'no_telp' },
                { data: 'action', orderable: false }
            ],
            columnDefs: [
                {
                    className: "text-center",
                    targets: "_all"  
                }
            ],
            language: {
                search: "",  
                paginate: {
                    first: '<i class="fa fa-angle-double-left"></i>',
                    last: '<i class="fa fa-angle-double-right"></i>',
                    next: '<i class="fa fa-angle-right"></i>',
                    previous: '<i class="fa fa-angle-left"></i>'
                }
            }
        });

        // Menambahkan placeholder pada input pencarian
        $('div.dataTables_wrapper input[type="search"]').attr('placeholder', 'Search...');
    });
</script>
@endsection
