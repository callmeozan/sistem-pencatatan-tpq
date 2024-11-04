<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpendaftar extends Model
{
    protected $table            = 'pendaftar';
    protected $primaryKey       = 'nomor_pendaftaran';
    protected $allowedFields    = ['kegiatan_id', 'user_id', 'nama_lengkap', 'no_hp', 'kelompok', 'jenis_kelamin', 'created_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    public function list()
    {
        return $this->table('pendaftar')
            ->select('pendaftar.*, kegiatan.judul_kegiatan, user.nama')
            ->join('kegiatan', 'kegiatan.kegiatan_id = pendaftar.kegiatan_id')
            ->join('user', 'user.user_id = pendaftar.user_id')
            ->orderBy('nomor_pendaftaran', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function check($kegiatan_id, $user_id)
    {
        return $this->table('pendaftar')
            ->where('kegiatan_id', $kegiatan_id)
            ->where('user_id', $user_id)
            ->countAllResults();
    }
}
