<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataRS;
use RealRashid\SweetAlert\Facades\Alert;


class DataRSController extends Controller
{

    public function index()
    {
        $title = 'Hapus data rumah sakit!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('data_rs.index');
    }

    public function data(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start', 0);  
        $length = $request->get('length', 10);  
        $searchValue = $request->input('search.value');

        // Total records
        $totalRecords = DataRS::count();

        $query = DataRS::select('*');

        // query search
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('nama', 'like', '%' . $searchValue . '%')
                    ->orWhere('alamat', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('no_telp', 'like', '%' . $searchValue . '%');
            });
        }


        $totalFilteredRecords = $query->count();

        //  pagination
        $records = $query->skip($start)
                        ->take($length)
                        ->get();

        // data untuk datatable
        $data = [];
        $counter = 1;
        foreach ($records as $record) {
            $data[] = [
                'id' => $counter++,
                'nama' => $record->nama,
                'alamat' => $record->alamat,
                'email' => $record->email,
                'no_telp' => $record->no_telp,
                'action' => '
                            <div class="btn-group" role="group">
                                <a href="'.route("data-rs.edit", ["id" => $record->id]).'" class="text-primary btn-update">
                                    <button type="button" class="btn btn-outline-success btn-xs me-4">Update</button> 
                                </a>
                                <a href="'.route('data-rs.destroy', $record->id).'" class="btn btn-outline-danger btn-xs rounded-2" style="width:80px; margin-right:20px; display:inline;" data-confirm-delete="true">Delete</a>
                            </div>'


            ];
        }
        return response()->json([
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalFilteredRecords,
            'aaData' => $data
        ]);
    }



    public function create()
    {
        return view('data_rs.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:data_rs,nama',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:data_rs,email', // Assuming `data_r_s` is your table
            'no_telp' => 'required|numeric|digits_between:10,15',
        ]);

        // Simpan data ke database
        DataRS::create($validated);

        // pesan sukses
        Alert::success('Success', 'Data berhasil disimpan!');
        return redirect()->route('data-rs.index');
    }


    public function edit($id)
    {
        $data = DataRS::findOrFail($id);
        return view('data_rs.edit', compact('data'));
    }
    

    public function update(Request $request, string $id)
    {
        // validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|unique:data_rs,nama,' . $id, 
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:data_rs,email,' . $id, 
            'no_telp' => 'required|numeric|digits_between:10,15',
        ]);
    
        // cari berdasarkan id 
        $data = DataRS::findOrFail($id);
    
        // Update the data record
        $data->update($validatedData);
        
        // kondisi berhasil atau tidak
        if ($data) {
            Alert::success('Success', 'Berhasil memperbaruhi data rumah sakit!');
            return redirect()->route('data-rs.index');
        } else {
            Alert::error('Error', 'Gagal memperbaruhi data rumah sakit!');
            return redirect()->back();
        }
    }
    

    public function destroy($id)
    {
        // cari berdasarkan id
        $data = DataRS::findOrFail($id);
        
        // Mengecek apakah ada pasien terkait dengan rumah sakit 
        $relatedDatas = $data->dataPasien()->exists();
        
        // Jika ada pasien terkait, tampilkan error dan jangan lanjutkan penghapusan
        if ($relatedDatas) {
            Alert::error('Error', 'Tidak dapat menghapus data rumah sakit, karena masih ada pasien!');
            return redirect()->back();
        }

        // Jika tidak ada pasien terkait, lanjutkan penghapusan data rumah sakit
        $data->delete();

        // Tampilkan pesan sukses setelah penghapusan berhasil
        Alert::success('Success', 'Berhasil hapus data!');
        return redirect()->back();
    }

}
