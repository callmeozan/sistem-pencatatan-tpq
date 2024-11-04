<?php

namespace App\Controllers;

use App\Models\Modelpengajar;
use CodeIgniter\Controller;

class Grafikpengajar extends Controller
{
    public function index()
    {
        $model = new Modelpengajar();
        $data['pendidikan'] = $model->getPendidikanData();

        // Dalam controller sebelum memanggil view
// view()->setGlobal('pendidikan', $model->getPendidikanData());

        return view('auth/grafik/index', $data);
    }
}
