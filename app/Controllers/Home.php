<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$pengajar = $this->pengajar->selectCount('pengajar_id')->first();
		$santri = $this->santri->selectCount('santri_id')->first();
		$kelas = $this->kelas->selectCount('kelas_id')->first();
		$konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
		$kegiatan = $this->kegiatan->published();
		$list_pengajar = $this->pengajar->orderBy('pengajar_id')->get()->getResultArray();
		$gallery = $this->gallery->list();
		$data = [
			'title' => 'Selamat Datang!',
			'pengajar' => $pengajar,
			'pengajar' => $pengajar,
			'santri' => $santri,
			'kelas' => $kelas,
			'konfigurasi' => $konfigurasi,
			'kegiatan' => $kegiatan,
			'list_pengajar' => $list_pengajar,
			'gallery' => $gallery,
		];
		return view('front/layout/menu', $data);
	}

	public function detail_kegiatan($slug_kegiatan = null)
	{
		if (!isset($slug_kegiatan)) return redirect()->to('/home#kegiatan');
		$konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
		$kegiatan = $this->kegiatan->detail_kegiatan($slug_kegiatan);

		if ($kegiatan) {
			$data = [
				'title'  => 'kegiatan - ' . $kegiatan->judul_kegiatan,
				'konfigurasi' => $konfigurasi,
				'kegiatan' => $kegiatan,
			];
			return view('front/kegiatan/detail', $data);
		} else {
			return redirect()->to('/home#kegiatan');
		}
	}

	public function detail_gallery($id = null)
	{
		if (!isset($id)) return redirect()->to('/home#gallery');
		$konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
		$gallery = $this->gallery->detail_gallery($id);
		$list_foto = $this->foto->detail_foto($id);
		if ($gallery) {
			$data = [
				'title'  => 'Gallery - ' . $gallery->nama_gallery,
				'konfigurasi' => $konfigurasi,
				'gallery' => $gallery,
				'list_foto' => $list_foto,

			];
			return view('front/gallery/detail', $data);
		} else {
			return redirect()->to('/home#gallery');
		}
	}

	public function cekinfaq()
	{
		$konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
		$data = [
			'title' => 'Cek infaq',
			'konfigurasi' => $konfigurasi,

		];
		return view('front/infaq/list', $data);
	}

	public function searchinfaq()
	{
		$keyword  = $this->request->getVar('keyword');
		if (!isset($keyword)) return redirect()->to('cekinfaq');
		$check = $this->infaq->get_infaq_keyword($keyword);
		if ($check) {

			$konfigurasi = $this->konfigurasi->orderBy('konfigurasi_id')->first();
			$data = [
				'title' => 'Cek infaq',
				'konfigurasi' => $konfigurasi,
				'infaq'	=> $check,
			];
			return view('front/infaq/search', $data);
		} else {
			session()->setFlashdata('alert', 'Nis yang anda masukkan tidak terdaftar!');
			return redirect()->to('cekinfaq');
		}
	}
}
