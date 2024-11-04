<?php

namespace App\Controllers;

class Mapel extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'mapel'
        ];
        return view('auth/mapel/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Mapel',
                'list' => $this->mapel->list()


            ];
            $msg = [
                'data' => view('auth/mapel/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah mapel',
                'mapel' => $this->mapel->orderBy('nama_mapel', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/mapel/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_mapel' => [
                    'label' => 'Nama Mapel',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'mapel_id'  => $validation->getError('mapel_id'),
                        'nama_mapel'  => $validation->getError('nama_mapel'),
                       
                    ]
                ];
            } else {
                $simpandata = [
                    'mapel_id'  => $this->request->getVar('mapel_id'),
                    'nama_mapel'  => $this->request->getVar('nama_mapel'),
                    'user_id'       => $this->request->getVar('user_id'),
                ];

                $this->mapel->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $mapel_id = $this->request->getVar('mapel_id');
            $list =  $this->mapel->find($mapel_id);
            $mapel =  $this->mapel->list();
            $data = [
                'title'         => 'Edit mapel',
                'mapel'      => $mapel,
                'mapel_id'     => $list['mapel_id'],
                'nama_mapel'  => $list['nama_mapel'],
            ];
            $msg = [
                'sukses' => view('auth/mapel/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'mapel_id' => [
                    'label' => 'Mapel ID',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nama_mapel' => [
                    'label' => 'Nama Mapel',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'mapel_id'  => $validation->getError('mapel_id'),
                        'nama_mapel'   => $validation->getError('nama_mapel'),
                        
                    ]
                ];
            } else {
                $updatedata = [
                    'mapel_id'  => $this->request->getVar('mapel_id'),
                    'nama_mapel'   => $this->request->getVar('nama_mapel'),
                    'user_id'       => $this->request->getVar('user_id'),
                ];

                $mapel_id = $this->request->getVar('mapel_id');
                $this->mapel->update($mapel_id, $updatedata);
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

            $mapel_id = $this->request->getVar('mapel_id');
            //check
            $cekdata = $this->mapel->find($mapel_id);
            $fotolama = $cekdata['gambar'];
            if ($fotolama != 'default.png') {
                unlink('img/mapel/' . $fotolama);
                unlink('img/mapel/thumb/' . 'thumb_' . $fotolama);
            }
            $this->mapel->delete($mapel_id);
            $msg = [
                'sukses' => 'Data Mapel Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $mapel_id = $this->request->getVar('mapel_id');
            $jmldata = count($mapel_id);
            for ($i = 0; $i < $jmldata; $i++) {
                //check
                $cekdata = $this->mapel->find($mapel_id[$i]);
                $fotolama = $cekdata['gambar'];
                if ($fotolama != 'default.png') {
                    unlink('img/mapel/' . $fotolama);
                    unlink('img/mapel/thumb/' . 'thumb_' . $fotolama);
                }
                $this->mapel->delete($mapel_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    
   


    //Start kategori (backend)
    public function mapel()
    {
        $data = [
            'title' => 'Mapel - mapel'
        ];
        return view('auth/mapel/index', $data);
    }

    public function getmapel()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Mapel - mapel',
                'list' => $this->mapel->orderBy('mapel_id', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/mapel/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formmapel()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Mapel'
            ];
            $msg = [
                'data' => view('auth/mapel/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanmapel()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_mapel' => [
                    'label' => 'Mapel',
                    'rules' => 'required|is_unique[mapel.nama_mapel]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_mapel' => $validation->getError('nama_mapel'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_mapel' => $this->request->getVar('nama_mapel'),
                    'slug_mapel' => $this->request->getVar('slug_mapel'),
                ];

                $this->mapel->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditmapel()
    {
        if ($this->request->isAJAX()) {
            $mapel_id = $this->request->getVar('mapel_id');
            $list =  $this->mapel->find($mapel_id);
            $data = [
                'title'           => 'Edit mapel',
                'mapel_id'     => $list['mapel_id'],
                'nama_mapel'   => $list['nama_mapel'],
            ];
            $msg = [
                'sukses' => view('auth/mapel/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatemapel()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_mapel' => [
                    'label' => 'Nama Mapel',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_mapel' => $validation->getError('nama_mapel'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_mapel' => $this->request->getVar('nama_mapel'),
                    'slug_mapel' => $this->request->getVar('slug_mapel'),
                ];

                $mapel_id = $this->request->getVar('mapel_id');
                $this->mapel->update($mapel_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusmapel()
    {
        if ($this->request->isAJAX()) {

            $mapel_id = $this->request->getVar('mapel_id');

            $this->mapel->delete($mapel_id);
            $msg = [
                'sukses' => 'mapel Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }
    //end kategori
}
