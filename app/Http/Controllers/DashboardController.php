<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataRS;
use App\Models\DataPasien;

class DashboardController extends Controller
{
    public function index()
    {
        $dataRS = DataRS::count();
        $dataPasien = DataPasien::count();
        $user = auth()->user();
        return view('dashboard', compact('user', 'dataRS', 'dataPasien'));
    }
}
