<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelkegiatan extends Model
{
    protected $table      = 'kegiatan';
    protected $primaryKey = 'kegiatan_id';
    protected $allowedFields = ['judul_kegiatan', 'slug_kegiatan', 'isi', 'gambar', 'tgl_kegiatan', 'status', 'user_id'];

    //backend
    public function list()
    {
        return $this->table('kegiatan')
            ->join('user', 'user.user_id = kegiatan.user_id')
            // Menghapus join ke kategori karena kategori_id sudah tidak ada
            ->orderBy('kegiatan_id', 'ASC')
            ->get()->getResultArray();
    }

    //frontend
    public function published()
    {
        return $this->table('kegiatan')
            ->join('user', 'user.user_id = kegiatan.user_id')
            // Menghapus join ke kategori karena kategori_id sudah tidak ada
            ->where('status', 'published')
            ->orderBy('kegiatan_id', 'ASC')
            ->get()->getResultArray();
    }

    public function detail_kegiatan($slug_kegiatan)
    {
        return $this->table('kegiatan')
            ->join('user', 'user.user_id = kegiatan.user_id')
            // Menghapus join ke kategori karena kategori_id sudah tidak ada
            ->where('slug_kegiatan', $slug_kegiatan)
            ->get()->getRow();
    }
}
