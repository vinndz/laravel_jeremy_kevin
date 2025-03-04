<?php

namespace App\Http\Controllers;

use App\Models\DataPasien;
use App\Models\DataRS;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DataPasienController extends Controller
{

    public function index()
    {
        $title = 'Delete Data Pasien!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('data_pasien.index');
    }

    public function data(Request $request)
    {
        // Get the values from the DataTable request
        $draw = $request->get('draw');
        $start = $request->get('start', 0);  // Default to 0
        $length = $request->get('length', 10);  // Default to 10
        $searchValue = $request->input('search.value');  // Search term from DataTable

        // Total records
        $totalRecords = DataPasien::count();

        // Query to apply search and pagination
        $query = DataPasien::select('*')
                            ->with('dataRS');  // Eager load the dataRS relationship

        // Apply search if there is a search value
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                // Search in dataRS (related model)
                $query->whereHas('dataRS', function ($query) use ($searchValue) {
                    $query->where('nama', 'like', '%' . $searchValue . '%');
                })
                // Search in main DataPasien model
                ->orWhere('nama', 'like', '%' . $searchValue . '%')
                ->orWhere('alamat', 'like', '%' . $searchValue . '%')
                ->orWhere('no_telp', 'like', '%' . $searchValue . '%');
            });
        }

        // Get the filtered total records
        $totalFilteredRecords = $query->count();

        // Apply pagination
        $records = $query->skip($start)
                        ->take($length)
                        ->get();

        // Prepare data for DataTable
        $data = [];
        
        foreach ($records as $record) {
            // Ensure we safely access dataRS relation
            $nama_rs = $record->dataRS ? ucwords($record->dataRS->nama) : '';  // Check if dataRS exists

            $data[] = [
                'id' => $record->id,
                'nama_rs' => $nama_rs,   // 'nama_rs' matches DataTable column definition
                'nama_pasien' => $record->nama,  // 'nama_pasien' matches DataTable column definition
                'alamat' => $record->alamat,
                'no_telp' => $record->no_telp,
                'action' => '
                            <div class="btn-group" role="group">
                                <a href="' . route("data-pasien.edit", ["id" => $record->id]) . '" class="text-primary btn-update">
                                    <button type="button" class="btn btn-outline-success btn-xs me-4">Update</button> 
                                </a>
                                <form action="' . route('data-pasien.destroy', ["id" => $record->id]) . '" method="POST" style="display:inline;">
                                    ' . method_field('DELETE') . '
                                    ' . csrf_field() . '
                                    <button type="submit" class="btn btn-outline-danger btn-xs">Delete</button>
                                </form>
                            </div>'
            ];
        }
        // Return the response as JSON for DataTable
        return response()->json([
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalFilteredRecords,
            'aaData' => $data
        ]);
    }


    public function create()
    {
        $data = DataRS::all();
        return view('data_pasien.create', compact('data'));
    }

    public function store(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'rs_id' => 'required|exists:data_rs,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:10,15',
        ]);

      
        $dataPasien = new DataPasien();
        $dataPasien->rs_id = $validatedData['rs_id'];
        $dataPasien->nama = $validatedData['nama'];
        $dataPasien->alamat = $validatedData['alamat'];
        $dataPasien->no_telp = $validatedData['no_telp'];

        // simpan ke database
        $dataPasien->save();

        // pesan sukses
        Alert::success('Success', 'Data Pasien Berhasil Ditambahkan!');
        return redirect()->route('data-pasien.index');
    }


    public function edit($id)
    {
        $dataPasien = DataPasien::findOrFail($id);
        $data = DataRS::all();  
        return view('data_pasien.edit', compact('dataPasien', 'data'));  
    }


    public function update(Request $request, $id)
    {
        // validasi data
        $validatedData = $request->validate([
            'rs_id' => 'required|exists:data_rs,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|numeric|digits_between:10,15',
        ]);

        // cari berdasarkan id
        $dataPasien = DataPasien::findOrFail($id); 

       
        $dataPasien->rs_id = $validatedData['rs_id'];
        $dataPasien->nama = $validatedData['nama'];
        $dataPasien->alamat = $validatedData['alamat'];
        $dataPasien->no_telp = $validatedData['no_telp'];

        // simpan ke database
        $dataPasien->save();

        // pesan sukses
        Alert::success('Success', 'Data Pasien Berhasil Diperbarui!');
        return redirect()->route('data-pasien.index'); 
    }

    public function destroy($id)
    {
        // cari id pasien
        $dataPasien = DataPasien::findOrFail($id);

        // hapus data pasien
        $dataPasien->delete();

        // pesan sukses
        Alert::success('Success', 'Data Pasien Berhasil Dihapus!');
        return redirect()->route('data-pasien.index'); 
    }

}
