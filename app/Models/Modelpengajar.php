<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpengajar extends Model
{
    protected $table      = 'pengajar';
    protected $primaryKey = 'pengajar_id';
    protected $allowedFields = ['nama', 'jekel', 'tmp_lahir', 'tgl_lahir', 'nik_ustadz', 'alamat', 'pendidikan', 'tahun_masuk', 'jabatan','keterangan'];

    public function getPendidikanData()
    {
        return $this->select('pendidikan, COUNT(pendidikan) as jumlah')
                    ->groupBy('pendidikan')
                    ->get()
                    ->getResultArray();
    }
}
