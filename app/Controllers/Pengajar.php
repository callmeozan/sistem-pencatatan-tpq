<?php

namespace App\Controllers;

use Config\Services;

class Pengajar extends BaseController
{
    public function password()
    {
        echo password_hash('123', PASSWORD_BCRYPT);
    }

    public function index()
    {
        if (session()->get('level') != 2) {
            return redirect()->to('dashboard');
        }

        return view('auth/pengajar/index', [
            'title' => 'Pengajar',
        ]);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List pengajar',
                'list' => $this->pengajar->orderBy('pengajar_id', 'ASC')->findAll()
            ];
            echo json_encode(['data' => view('auth/pengajar/list', $data)]);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = ['title' => 'Tambah Pengajar'];
            echo json_encode(['data' => view('auth/pengajar/tambah', $data)]);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama pengajar',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'jekel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'tmp_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'nik_ustadz' => [
                    'label' => 'NIK',
                    'rules' => 'required|is_unique[pengajar.nik_ustadz]|min_length[16]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'min_length' => '{field} minimal 16'
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'pendidikan' => [
                    'label' => 'Pendidikan',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'tahun_masuk' => [
                    'label' => 'Tahun Masuk',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'jabatan' => [
                    'label' => 'Jabatan',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'jekel' => $validation->getError('jekel'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'nik_ustadz' => $validation->getError('nik_ustadz'),
                        'alamat' => $validation->getError('alamat'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'tahun_masuk' => $validation->getError('tahun_masuk'),
                        'jabatan' => $validation->getError('jabatan'),
                        'keterangan' => $validation->getError('keterangan')
                    ]
                ];
            } else {
                $simpandata = [
                    'nama' => $this->request->getVar('nama'),
                    'jekel' => $this->request->getVar('jekel'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'nik_ustadz' => $this->request->getVar('nik_ustadz'),
                    'alamat' => $this->request->getVar('alamat'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'tahun_masuk' => $this->request->getVar('tahun_masuk'),
                    'jabatan' => $this->request->getVar('jabatan'),
                    'keterangan' => $this->request->getVar('keterangan'),
                ];

                $this->pengajar->insert($simpandata);
                $msg = ['sukses' => 'Data berhasil disimpan'];
            }

            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $pengajar_id = $this->request->getVar('pengajar_id');
            $list = $this->pengajar->find($pengajar_id);

            $data = [
                'title' => 'Edit Pengajar',
                'pengajar_id' => $list['pengajar_id'],
                'nama' => $list['nama'],
                'jekel' => $list['jekel'],
                'tmp_lahir' => $list['tmp_lahir'],
                'tgl_lahir' => $list['tgl_lahir'],
                'nik_ustadz' => $list['nik_ustadz'],
                'alamat' => $list['alamat'],
                'pendidikan' => $list['pendidikan'],
                'tahun_masuk' => $list['tahun_masuk'],
                'jabatan' => $list['jabatan'],
                'keterangan' => $list['keterangan'],
            ];

            echo json_encode(['sukses' => view('auth/pengajar/edit', $data)]);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama pengajar',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'jekel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'tmp_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'nik_ustadz' => [
                    'label' => 'NIK',
                    'rules' => 'required|min_length[16]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 16'
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'pendidikan' => [
                    'label' => 'Pendidikan',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'tahun_masuk' => [
                    'label' => 'Tahun Masuk',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'jabatan' => [
                    'label' => 'Jabatan',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => ['required' => '{field} tidak boleh kosong']
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'jekel' => $validation->getError('jekel'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'nik_ustadz' => $validation->getError('nik_ustadz'),
                        'alamat' => $validation->getError('alamat'),
                        'pendidikan' => $validation->getError('pendidikan'),
                        'tahun_masuk' => $validation->getError('tahun_masuk'),
                        'jabatan' => $validation->getError('jabatan'),
                        'keterangan' => $validation->getError('keterangan')
                    ]
                ];
            } else {
                $updatedata = [
                    'nama' => $this->request->getVar('nama'),
                    'jekel' => $this->request->getVar('jekel'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'nik_ustadz' => $this->request->getVar('nik_ustadz'),
                    'alamat' => $this->request->getVar('alamat'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'tahun_masuk' => $this->request->getVar('tahun_masuk'),
                    'jabatan' => $this->request->getVar('jabatan'),
                    'keterangan' => $this->request->getVar('keterangan'),
                ];

                $pengajar_id = $this->request->getVar('pengajar_id');
                $this->pengajar->update($pengajar_id, $updatedata);
                $msg = ['sukses' => 'Data berhasil diupdate'];
            }

            echo json_encode($msg);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $pengajar_id = $this->request->getVar('pengajar_id');
            $this->pengajar->delete($pengajar_id);
            $msg = ['sukses' => 'Data berhasil dihapus'];

            echo json_encode($msg);
        }
    }
}
