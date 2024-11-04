<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkelas extends Model
{
    protected $table      = 'kelas';
    protected $primaryKey = 'kelas_id';
    protected $allowedFields = ['nama_kelas', 'pengajar_id'];

    //backend
    public function list()
    {
        return $this->table('kelas')
            ->orderBy('nama_kelas', 'ASC')
            ->get()->getResultArray();
    }

    public function listjoin()
    {
        return $this->table('kelas')
            ->join('pengajar', 'pengajar.pengajar_id = kelas.pengajar_id')
            ->orderBy('kelas_id', 'ASC')
            ->get()->getResultArray();
    }
}
