<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelnilai;
use App\Models\Modelsantri;
use CodeIgniter\HTTP\ResponseInterface;

class Nilai extends BaseController
{
    protected $modelnilai; // Sesuaikan dengan huruf kecil untuk objek model

    public function __construct()
    {
        $this->modelnilai = new Modelnilai(); // Pastikan ini sesuai dengan nama model
    }

    public function index()
    {
        $bacaNilai = new Modelnilai();

        $data = [
            'title' => 'Input Nilai',
            'bacaNilai' => $bacaNilai->getAllNilai(),
        ];

        return view('auth/nilai/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List Nilai',

            ];
            $msg = [
                'data' => view('auth/nilai/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function getnilai()
    {
        $model = new Modelnilai();
        $data = $model->getAllNilai();
        $i = 1;

        // Format data untuk DataTables
        $hasil = [
            "draw" => intval($this->request->getPost('draw')),
            "recordsTotal" => $model->countAll(),
            "recordsFiltered" => $model->countAll(),
            "data" => []
        ];

        foreach ($data as $row) {
            if ($row['kefasihan'] > $row['kelancaran']) {
                $nilai = $row['kefasihan']; // Ambil nilai dari kolom kefasihan
            } else {
                $nilai = $row['kelancaran']; // Ambil nilai dari kolom kelancaran
            }

            $grade = '';
            if ($nilai >= 81) {
                $grade = 'A'; // Untuk nilai di atas 80
            } elseif ($nilai >= 61) {
                $grade = 'B'; // Untuk nilai antara 61 dan 80
            } elseif ($nilai == 60) {
                $grade = 'C'; // Untuk nilai tepat 60
            } else {
                $grade = 'D'; // Untuk nilai di bawah 60
            }

            $hasil['data'][] = [
                // '<input type="checkbox" class="check-item" value="' . $row['nilai_id'] . '">',
                $i++,
                $row['santri_id'],
                $row['pengajar_id'],
                $row['jilid_hal'],
                $row['surat'],
                $row['kelancaran'],
                $row['kefasihan'],
                $grade,
                $row['paraf'] === 'Diterima'
                    ? '<span class="badge badge-success">Diterima</span>'
                    : '<span class="badge badge-warning">Ditolak</span>',
                '<button class="btn btn-primary btn-sm btn-update" data-id="' . $row['nilai_id'] . '"><i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm btn-delete" data-id="' . $row['nilai_id'] . '"><i class="fa fa-trash"></i></button>'
            ];
        }

        return $this->response->setJSON($hasil);
    }

    public function getNilaiById()
    {
        // Mendapatkan nilai_id dari permintaan AJAX
        $model = new Modelnilai();
        $nilai_id = $this->request->getPost('nilai_id');

        log_message('debug', 'nilai_id: ' . $nilai_id);

        // Cari data berdasarkan nilai_id
        $data = $model->find($nilai_id);

        return $this->response->setJSON($data);
        // if (!empty($data)) {
        //     return $this->response->setJSON($data[0]); // Mengembalikan objek pertama dari hasil
        // } else {
        //     return $this->response->setJSON(['error' => 'Data tidak ditemukan']);
        // }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Nilai',
            ];

            $viewContent = view('auth/nilai/tambah', $data);

            if ($viewContent) {
                $msg = [
                    'data' => $viewContent
                ];
                $this->response->setContentType('application/json');
                echo json_encode($msg);
            } else {
                //kirim pesan kesalahan
                echo json_encode(['error' => 'View tidak ditemukan.']);
            }
        }
    }
    public function formEdit()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Edit Nilai',
            ];

            $viewContent = view('auth/nilai/edit', $data);

            if ($viewContent) {
                $msg = [
                    'data' => $viewContent
                ];
                $this->response->setContentType('application/json');
                echo json_encode($msg);
            } else {
                //kirim pesan kesalahan
                echo json_encode(['error' => 'View tidak ditemukan.']);
            }
        }
    }

    public function saveData()
    {
        $data = $this->request->getPost();
        $modelInputNilai = new Modelnilai();


        try {
            $modelInputNilai->save($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Data Berhasil Ditambahkan']);
        } catch (\Throwable $th) {
            return $this->response->setJSON(['success' => false, 'error' => $th->getMessage()]);
        }
    }

    public function deleteData($nilai_id)
    {
        $data = $this->modelnilai->find($nilai_id);
        if ($data) {
            $this->modelnilai->delete($nilai_id);
            return redirect()->to('/nilai')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to('/nilai')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function updateData()
    {
        $modelNilai = new Modelnilai(); // Inisialisasi model di sini

        // Mendapatkan nilai_id dari input form
        $nilai_id = $this->request->getPost('id');
        $data = [
            'santri_id' => $this->request->getPost('nama'),
            'pengajar_id' => $this->request->getPost('pengajar'),
            'jilid_hal' => $this->request->getPost('halaman'),
            'surat' => $this->request->getPost('surah'),
            'kelancaran' => $this->request->getPost('kelancaran'),
            'kefasihan' => $this->request->getPost('kefasihan'),
            'nilai' => "",
            'paraf' => $this->request->getPost('keterangan')
        ];

        try {
            $updateStatus = $modelNilai->update($nilai_id, $data);
            if ($updateStatus) {
                return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui data']);
            }
        } catch (\Throwable $th) {
            return $this->response->setJSON(['success' => false, 'error' => $th->getMessage()]);
        }
    }
}

