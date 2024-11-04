<?php

namespace App\Controllers;

class Kegiatan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Kegiatan'
        ];
        return view('auth/kegiatan/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Kegiatan',
                'list' => $this->kegiatan->list()
            ];
            $msg = [
                'data' => view('auth/kegiatan/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Kegiatan'
                // Removed 'kategori' => $this->kategori->orderBy('nama_kategori', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/kegiatan/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul_kegiatan' => [
                    'label' => 'Judul Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                // Removed 'kategori_id' validation
                'isi' => [
                    'label' => 'Isi Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul_kegiatan'  => $validation->getError('judul_kegiatan'),
                        // Removed 'kategori_id' error
                        'isi'           => $validation->getError('isi'),
                        'status'        => $validation->getError('status'),
                    ]
                ];
            } else {
                $simpandata = [
                    'judul_kegiatan'  => $this->request->getVar('judul_kegiatan'),
                    'slug_kegiatan'   => $this->request->getVar('slug_kegiatan'),
                    // Removed 'kategori_id'
                    'isi'           => $this->request->getVar('isi'),
                    'status'        => $this->request->getVar('status'),
                    'gambar'        => $this->request->getVar('gambar'),
                    'tgl_kegiatan'    => $this->request->getVar('tgl_kegiatan'),
                    'user_id'       => $this->request->getVar('user_id'),
                ];

                $this->kegiatan->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formdaftar()
    {
        if ($this->request->isAJAX()) {
            $kegiatan_id = $this->request->getVar('kegiatan_id');
            $list =  $this->kegiatan->find($kegiatan_id);
            $data = [
                'title'         => 'Daftar Kegiatan',
                // Removed 'kategori'
                'kegiatan_id'     => $list['kegiatan_id'],
                'judul_kegiatan'  => $list['judul_kegiatan'],
                // Removed 'kategori_id'
                'isi'           => $list['isi'],
                'status'        => $list['status'],
            ];
            $msg = [
                'sukses' => view('auth/kegiatan/daftar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function daftarkegiatan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'no_hp' => [
                    'label' => 'Nomor HP',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus angka'
                    ]
                ],
                'kelompok' => [
                    'label' => 'Kelompok',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenis_kelamin' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'no_hp'   => $validation->getError('no_hp'),
                        'kelompok'           => $validation->getError('kelompok'),
                        'jenis_kelamin'        => $validation->getError('jenis_kelamin'),
                    ]
                ];
            } else {
                $simpandata = [
                    'kegiatan_id'  => $this->request->getVar('kegiatan_id'),
                    'user_id'   => $this->request->getVar('user_id'),
                    'no_hp'           => $this->request->getVar('no_hp'),
                    'kelompok'        => $this->request->getVar('kelompok'),
                    'jenis_kelamin'        => $this->request->getVar('jenis_kelamin'),
                ];

                if ($this->pendaftar->check($this->request->getVar('kegiatan_id'), $this->request->getVar('user_id')) > 0) {
                    $msg = [
                        'pesan' => 'Anda sudah mendaftar kegiatan ini'
                    ];
                } else {
                    $this->pendaftar->insert($simpandata);
                    $msg = [
                        'sukses' => 'Data berhasil disimpan',
                    ];
                }
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $kegiatan_id = $this->request->getVar('kegiatan_id');
            $list =  $this->kegiatan->find($kegiatan_id);
            $data = [
                'title'         => 'Edit Kegiatan',
                // Removed 'kategori'
                'kegiatan_id'     => $list['kegiatan_id'],
                'judul_kegiatan'  => $list['judul_kegiatan'],
                // Removed 'kategori_id'
                'isi'           => $list['isi'],
                'status'        => $list['status'],
            ];
            $msg = [
                'sukses' => view('auth/kegiatan/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul_kegiatan' => [
                    'label' => 'Judul kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                // Removed 'kategori_id' validation
                'isi' => [
                    'label' => 'Isi Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status' => [
                    'label' => 'Status',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul_kegiatan'  => $validation->getError('judul_kegiatan'),
                        // Removed 'kategori_id' error
                        'isi'           => $validation->getError('isi'),
                        'status'        => $validation->getError('status'),
                    ]
                ];
            } else {
                $updatedata = [
                    'judul_kegiatan'  => $this->request->getVar('judul_kegiatan'),
                    'slug_kegiatan'   => $this->request->getVar('slug_kegiatan'),
                    // Removed 'kategori_id'
                    'isi'           => $this->request->getVar('isi'),
                    'status'        => $this->request->getVar('status'),
                    'tgl_kegiatan'    => $this->request->getVar('tgl_kegiatan'),
                    'user_id'       => $this->request->getVar('user_id'),
                ];

                $kegiatan_id = $this->request->getVar('kegiatan_id');
                $this->kegiatan->update($kegiatan_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $kegiatan_id = $this->request->getVar('kegiatan_id');
            $this->kegiatan->delete($kegiatan_id);
            $msg = [
                'sukses' => 'Data berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    public function detail()
    {
        if ($this->request->isAJAX()) {
            $kegiatan_id = $this->request->getVar('kegiatan_id');
            $data = $this->kegiatan->find($kegiatan_id);
            $msg = [
                'sukses' => view('auth/kegiatan/detail', $data)
            ];
            echo json_encode($msg);
        }
    }
}
