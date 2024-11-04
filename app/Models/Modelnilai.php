<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelnilai extends Model
{
    protected $table            = 'nilai';
    protected $primaryKey       = 'nilai_id';
    protected $allowedFields    = ['santri_id', 'pengajar_id', 'jilid_hal', 'surat', 'kelancaran', 'kefasihan', 'nilai', 'paraf'];

    public function getAllNilai()
    {
        return $this->findAll(); // Mengembalikan semua data dari tabel 'nilai'
    }

    public function update($nilai_id = null, $data = null): bool
    {
        return $this->db->table('nilai')->update($data, ['nilai_id' => $nilai_id]);
    }

    public function getNilaiById($nilai_id)
    {
        return $this->where('nilai_id', $nilai_id)->first();
        log_message('debug', 'Hasil query: ' . json_encode($result));
        return $result;
    }

    // public function editData($santri_id, $pengajar_id, $jilid_hal, $surat, $kelancaran, $kefasihan, $paraf)
    // {
    //     $data = [
    //         'santri_id' => $santri_id,
    //         'pengajar_id' => $pengajar_id,
    //         'jilid_hal' => $jilid_hal,
    //         'surat' => $surat,
    //         'kelancaran' => $kelancaran,
    //         'kefasihan' => $kefasihan,
    //         'paraf' => $paraf
    //     ];

    //     $this->update($nilai_id, $data);
    // }
}
