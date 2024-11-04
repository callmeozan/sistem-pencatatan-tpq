<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('login');
        }
        $pengajar = $this->pengajar->selectCount('pengajar_id')->first();
        $santri = $this->santri->selectCount('santri_id')->first();
        $kelas = $this->kelas->selectCount('kelas_id')->first();
        $gallery = $this->gallery->selectCount('gallery_id')->first();
        $kegiatan = $this->kegiatan->selectCount('kegiatan_id')->first();
        $data = [
            'title' => 'Admin - Dashboard',
            'pengajar' => $pengajar,
            'santri' => $santri,
            'kelas' => $kelas,
            'gallery' => $gallery,
            'kegiatan' => $kegiatan,
        ];
        return view('auth/dashboard', $data);
    }
}
