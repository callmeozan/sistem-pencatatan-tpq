<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Modelsantri;

class Santri extends BaseController
{

    public function index()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title' => 'santri',
        ];
        return view('auth/santri/index', $data);
    }

    public function getdata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'List santri',
                'list' => $this->santri->list()

            ];
            $msg = [
                'data' => view('auth/santri/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function getdatasantri()
    {
        $request = Services::request();
        $datamodel = $this->santri;
        if ($request->getMethod()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;

                $row = [];
                $edit = "<button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"edit('" . $list->santri_id . "')\">
                <i class=\"fa fa-edit\"></i>
            </button>";
                $hapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->santri_id . "')\">
                <i class=\"fa fa-trash\"></i>
            </button>";

                $row[] = "<input type=\"checkbox\" name=\"santri_id[]\" class=\"centangsantriid\" value=\"$list->santri_id\">";
                $row[] = $no;
                $row[] = $list->nama;
                $row[] = $list->nism;
                $row[] = $list->nisn;
                $row[] = $list->tahun_masuk;
                $row[] = $list->nik;
                $row[] = $list->nama_kelas;
                $row[] = $list->tmp_lahir . ", " . date_indo($list->tgl_lahir);
                $row[] = $list->jenkel;
                $row[] = $list->anake;
                $row[] = $list->jml_saudara;
                $row[] = $list->nama_ibu;
                $row[] = $list->keterangan;

                $row[] = $edit . " " . $hapus;
                $data[] = $row;
            }
            $output = [
                "recordTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];

            echo json_encode($output);
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah santri',
                'kelas' => $this->kelas->orderBy('nama_kelas', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/santri/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama santri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nism' => [
                    'label' => 'Nism',
                    'rules' => 'required|is_unique[santri.nis]|min_length[5]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'min_length' => '{field} minimal 5',
                    ]
                ],
                'nisn' => [
                    'label' => 'Nisn',
                    'rules' => 'required|is_unique[santri.nis]|min_length[5]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'min_length' => '{field} minimal 5',
                    ]
                ],
                'tahun_masuk' => [
                    'label' => 'Tahun Masuk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nik' => [
                    'label' => 'Nik',
                    'rules' => 'required|is_unique[santri.nis]|min_length[5]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'min_length' => '{field} minimal 5',
                    ]
                ],
                
                'kelas_id' => [
                    'label' => 'Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tmp_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'anake' => [
                    'label' => 'Anake',
                    'rules' => 'required|is_unique[santri.nis]|min_length[5]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                        'min_length' => '{field} minimal 5',
                    ]
                ],
                'jml_saudara' => [
                        'label' => 'Jumlah Saudara',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                ],
                'nama_ibu' => [
                        'label' => 'Nama Ibu',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                ],
                'keterangan' => [
                        'label' => 'Keterangan',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                    ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'nism' => $validation->getError('nism'),
                        'nisn' => $validation->getError('nisn'),
                        'tahun_masuk' => $validation->getError('tahun_masuk'),
                        'nik' => $validation->getError('nik'),
                        'kelas_id' => $validation->getError('kelas_id'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenkel' => $validation->getError('jenkel'),
                        'anake' => $validation->getError('anake'),
                        'jml_saudara' => $validation->getError('jml_saudara'),
                        'nama_ibu' => $validation->getError('nama_ibu'),
                        'keterangan' => $validation->getError('keterangan')
                    ]
                ];
            } else {
                $simpandata = [
                    'nama' => $this->request->getVar('nama'),
                    'nism' => $this->request->getVar('nism'),
                    'nisn' => $this->request->getVar('nisn'),
                    'tahun_masuk' => $this->request->getVar('tahun_masuk'),
                    'nik' => $this->request->getVar('nik'),
                    'kelas_id' => $this->request->getVar('kelas_id'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'jenkel' => $this->request->getVar('jenkel'),
                    'anake' => $this->request->getVar('anake'),
                    'jml_saudara' => $this->request->getVar('jml_saudara'),
                    'nama_ibu' => $this->request->getVar('nama_ibu'),
                    'keterangan' => $this->request->getVar('keterangan'),
                ];

                $this->santri->insert($simpandata);
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
            $santri_id = $this->request->getVar('santri_id');
            $list =  $this->santri->find($santri_id);
            $kelas =  $this->kelas->list();
            $data = [
                'title'         => 'Edit Santri',
                'kelas'         => $kelas,
                'santri_id'      => $list['santri_id'],
                'nama'          => $list['nama'],
                'nism'           => $list['nism'],
                'nisn'           => $list['nisn'],
                'tahun_masuk'    => $list['tahun_masuk'],
                'nik'           => $list['nik'],
                'kelas_id'      => $list['kelas_id'],
                'tmp_lahir'     => $list['tmp_lahir'],
                'tgl_lahir'     => $list['tgl_lahir'],
                'jenkel'        => $list['jenkel'],
                'anake'           => $list['anake'],
                'jml_saudara'          => $list['jml_saudara'],
                'nama_ibu'          => $list['nama_ibu'],
                'keterangan'          => $list['keterangan'],
            ];
            $msg = [
                'sukses' => view('auth/santri/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Santri',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nism' => [
                    'label' => 'Nism',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nisn' => [
                    'label' => 'Nisn',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tahun_masuk' => [
                    'label' => 'Tahun Masuk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nik' => [
                    'label' => 'Nik',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                
                'kelas_id' => [
                    'label' => 'Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tmp_lahir' => [
                    'label' => 'Tempat Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'tgl_lahir' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'anake' => [
                    'label' => 'Anake',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'jml_saudara' => [
                        'label' => 'Jumlah Saudara',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                ],
                'nama_ibu' => [
                        'label' => 'Nama Ibu',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} tidak boleh kosong',
                        ]
                ],
                'keterangan' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'nism' => $validation->getError('nism'),
                        'nisn' => $validation->getError('nisn'),
                        'tahun_masuk' => $validation->getError('tahun_masuk'),
                        'nik' => $validation->getError('nik'),
                        'kelas_id' => $validation->getError('kelas_id'),
                        'tmp_lahir' => $validation->getError('tmp_lahir'),
                        'tgl_lahir' => $validation->getError('tgl_lahir'),
                        'jenkel' => $validation->getError('jenkel'),
                        'anake' => $validation->getError('anake'),
                        'jml_saudara' => $validation->getError('jml_saudara'),
                        'nama_ibu' => $validation->getError('nama_ibu'),
                        'keterangan' => $validation->getError('keterangan'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama' => $this->request->getVar('nama'),
                    'nism' => $this->request->getVar('nism'),
                    'nisn' => $this->request->getVar('nisn'),
                    'tahun_masuk' => $this->request->getVar('tahun_masuk'),
                    'nik' => $this->request->getVar('nik'),
                    'kelas_id' => $this->request->getVar('kelas_id'),
                    'tmp_lahir' => $this->request->getVar('tmp_lahir'),
                    'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                    'jenkel' => $this->request->getVar('jenkel'),
                    'anake' => $this->request->getVar('anake'),
                    'jml_saudara' => $this->request->getVar('jml_saudara'),
                    'keterangan' => $this->request->getVar('keterangan'),
                ];

                $santri_id = $this->request->getVar('santri_id');
                $this->santri->update($santri_id, $updatedata);
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

            $santri_id = $this->request->getVar('santri_id');
            $this->santri->delete($santri_id);
            $msg = [
                'sukses' => 'Data Staf Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusall()
    {
        if ($this->request->isAJAX()) {
            $santri_id = $this->request->getVar('santri_id');
            $jmldata = count($santri_id);
            for ($i = 0; $i < $jmldata; $i++) {
                $this->santri->delete($santri_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }


    //Start kelas (backend)
    public function kelas()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('dashboard');
        }
        $data = [
            'title' => 'Kelas'
        ];
        return view('auth/kelas/index', $data);
    }

    public function getkelas()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'santri - Kelas',
                'list' => $this->kelas->listjoin()
            ];
            $msg = [
                'data' => view('auth/kelas/list', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function formkelas()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Kelas',
                'pengajar' => $this->pengajar->orderBy('nama', 'ASC')->findAll()
            ];
            $msg = [
                'data' => view('auth/kelas/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpankelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kelas' => [
                    'label' => 'Nama Kelas',
                    'rules' => 'required|is_unique[kelas.nama_kelas]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ],
                'pengajar_id' => [
                    'label' => 'Wali kelas',
                    'rules' => 'required|is_unique[kelas.pengajar_id]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas'),
                        'pengajar_id' => $validation->getError('pengajar_id'),
                    ]
                ];
            } else {
                $simpandata = [
                    'nama_kelas' => $this->request->getVar('nama_kelas'),
                    'pengajar_id'    => $this->request->getVar('pengajar_id'),
                ];

                $this->kelas->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditkelas()
    {
        if ($this->request->isAJAX()) {
            $kelas_id = $this->request->getVar('kelas_id');
            $list =  $this->kelas->find($kelas_id);
            $pengajar =  $this->pengajar->list();
            $data = [
                'title'           => 'Edit Kelas',
                'pengajar'            => $pengajar,
                'kelas_id'        => $list['kelas_id'],
                'nama_kelas'      => $list['nama_kelas'],
                'pengajar_id'         => $list['pengajar_id'],
            ];
            $msg = [
                'sukses' => view('auth/kelas/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatekelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama_kelas' => [
                    'label' => 'Nama Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'pengajar_id' => [
                    'label' => 'Wali kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama_kelas' => $validation->getError('nama_kelas'),
                        'pengajar_id' => $validation->getError('pengajar_id'),
                    ]
                ];
            } else {
                $updatedata = [
                    'nama_kelas' => $this->request->getVar('nama_kelas'),
                    'pengajar_id' => $this->request->getVar('pengajar_id'),
                ];

                $kelas_id = $this->request->getVar('kelas_id');
                $this->kelas->update($kelas_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapuskelas()
    {
        if ($this->request->isAJAX()) {

            $kelas_id = $this->request->getVar('kelas_id');

            $this->kelas->delete($kelas_id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }
    //end kelas

    //Start infaq (Back-end)
    public function infaq()
    {
        if (session()->get('level') <> 2) {
            return redirect()->to('dashboard');
        }
        $data = [
            'title' => 'santri - Infaq'
        ];
        return view('auth/infaq/index', $data);
    }

    public function getinfaq()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'santri - Infaq',
                'list' => $this->infaq->listjoin()
            ];
            $msg = [
                'data' => view('auth/infaq/list', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function getdatainfaq()
    {
        $request = Services::request();
        $datamodel = $this->infaq;
        if ($request->getMethod()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;

                $row = [];
                $edit = "<button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"edit('" . $list->infaq_id . "')\">
                <i class=\"fa fa-edit\"></i>
            </button>";
                $hapus = "<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"hapus('" . $list->infaq_id . "')\">
                <i class=\"fa fa-trash\"></i>
            </button>";

                $row[] = "<input type=\"checkbox\" name=\"infaq_id[]\" class=\"centangInfaqid\" value=\"$list->infaq_id\">";
                $row[] = $no;
                $row[] = $list->nis;
                $row[] = $list->nama;
                $row[] = $list->nama_kelas;
                $row[] = $edit . " " . $hapus;
                $data[] = $row;
            }
            $output = [
                "recordTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];

            echo json_encode($output);
        }
    }

    public function forminfaq()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Tambah Data infaq',
                'santri' => $this->santri->list()
            ];
            $msg = [
                'data' => view('auth/infaq/tambah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpaninfaq()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'santri_id' => [
                    'label' => 'Nama santri',
                    'rules' => 'required|is_unique[infaq.santri_id]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama',
                    ]
                ],
                'januari' => [
                    'label' => 'Januari',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'februari' => [
                    'label' => 'Februari',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'maret' => [
                    'label' => 'Maret',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'april' => [
                    'label' => 'April',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'mei' => [
                    'label' => 'Mei',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'juni' => [
                    'label' => 'Juni',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'juli' => [
                    'label' => 'Juli',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'agustus' => [
                    'label' => 'Agustus',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'september' => [
                    'label' => 'September',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'oktober' => [
                    'label' => 'Oktober',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'november' => [
                    'label' => 'November',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'desember' => [
                    'label' => 'Desember',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'santri_id' => $validation->getError('santri_id'),
                        'januari' => $validation->getError('januari'),
                        'februari' => $validation->getError('februari'),
                        'maret' => $validation->getError('maret'),
                        'april' => $validation->getError('april'),
                        'mei' => $validation->getError('mei'),
                        'juni' => $validation->getError('juni'),
                        'juli' => $validation->getError('juli'),
                        'agustus' => $validation->getError('agustus'),
                        'september' => $validation->getError('september'),
                        'oktober' => $validation->getError('oktober'),
                        'november' => $validation->getError('november'),
                        'desember' => $validation->getError('desember'),
                    ]
                ];
            } else {
                $simpandata = [
                    'santri_id' => $this->request->getVar('santri_id'),
                    'januari'    => $this->request->getVar('januari'),
                    'februari'    => $this->request->getVar('februari'),
                    'maret'    => $this->request->getVar('maret'),
                    'april'    => $this->request->getVar('april'),
                    'mei'    => $this->request->getVar('mei'),
                    'juni'    => $this->request->getVar('juni'),
                    'juli'    => $this->request->getVar('juli'),
                    'agustus'    => $this->request->getVar('agustus'),
                    'september'    => $this->request->getVar('september'),
                    'oktober'    => $this->request->getVar('oktober'),
                    'november'    => $this->request->getVar('november'),
                    'desember'    => $this->request->getVar('desember'),
                ];

                $this->infaq->insert($simpandata);
                $msg = [
                    'sukses' => 'Data berhasil disimpan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formeditinfaq()
    {
        if ($this->request->isAJAX()) {
            $infaq_id = $this->request->getVar('infaq_id');
            $list =  $this->infaq->find($infaq_id);
            $santri =  $this->santri->list();
            $data = [
                'title'             => 'Edit Data infaq',
                'santri'             => $santri,
                'infaq_id'            => $list['infaq_id'],
                'januari'           => $list['januari'],
                'februari'          => $list['februari'],
                'maret'             => $list['maret'],
                'april'             => $list['april'],
                'mei'               => $list['mei'],
                'juni'              => $list['juni'],
                'juli'              => $list['juli'],
                'agustus'           => $list['agustus'],
                'september'         => $list['september'],
                'oktober'           => $list['oktober'],
                'november'          => $list['november'],
                'desember'          => $list['desember'],
                'santri_id'          => $list['santri_id'],
            ];
            $msg = [
                'sukses' => view('auth/infaq/edit', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updateinfaq()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([

                'januari' => [
                    'label' => 'Januari',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'februari' => [
                    'label' => 'Februari',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'maret' => [
                    'label' => 'Maret',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'april' => [
                    'label' => 'April',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'mei' => [
                    'label' => 'Mei',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'juni' => [
                    'label' => 'Juni',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'juli' => [
                    'label' => 'Juli',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'agustus' => [
                    'label' => 'Agustus',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'september' => [
                    'label' => 'September',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'oktober' => [
                    'label' => 'Oktober',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'november' => [
                    'label' => 'November',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'desember' => [
                    'label' => 'Desember',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'santri_id' => $validation->getError('santri_id'),
                        'januari' => $validation->getError('januari'),
                        'februari' => $validation->getError('februari'),
                        'maret' => $validation->getError('maret'),
                        'april' => $validation->getError('april'),
                        'mei' => $validation->getError('mei'),
                        'juni' => $validation->getError('juni'),
                        'juli' => $validation->getError('juli'),
                        'agustus' => $validation->getError('agustus'),
                        'september' => $validation->getError('september'),
                        'oktober' => $validation->getError('oktober'),
                        'november' => $validation->getError('november'),
                        'desember' => $validation->getError('desember'),
                    ]
                ];
            } else {
                $updatedata = [
                    'santri_id' => $this->request->getVar('santri_id'),
                    'januari'    => $this->request->getVar('januari'),
                    'februari'    => $this->request->getVar('februari'),
                    'maret'    => $this->request->getVar('maret'),
                    'april'    => $this->request->getVar('april'),
                    'mei'    => $this->request->getVar('mei'),
                    'juni'    => $this->request->getVar('juni'),
                    'juli'    => $this->request->getVar('juli'),
                    'agustus'    => $this->request->getVar('agustus'),
                    'september'    => $this->request->getVar('september'),
                    'oktober'    => $this->request->getVar('oktober'),
                    'november'    => $this->request->getVar('november'),
                    'desember'    => $this->request->getVar('desember'),
                ];

                $infaq_id = $this->request->getVar('infaq_id');
                $this->infaq->update($infaq_id, $updatedata);
                $msg = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function hapusinfaq()
    {
        if ($this->request->isAJAX()) {

            $infaq_id = $this->request->getVar('infaq_id');

            $this->infaq->delete($infaq_id);
            $msg = [
                'sukses' => 'Data Berhasil Dihapus'
            ];

            echo json_encode($msg);
        }
    }

    public function hapusallinfaq()
    {
        if ($this->request->isAJAX()) {
            $infaq_id = $this->request->getVar('infaq_id');
            $jmldata = count($infaq_id);
            for ($i = 0; $i < $jmldata; $i++) {
                $this->infaq->delete($infaq_id[$i]);
            }

            $msg = [
                'sukses' => "$jmldata Data berhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }
  

    
}
