<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modelsantri extends Model
{
    protected $table      = 'santri';
    protected $primaryKey = 'santri_id';
    protected $allowedFields = ['nama','nism','nisn','tahun_masuk','nik','kelas_id', 'tgl_lahir', 'tmp_lahir', 'jenkel','anake','jml_saudara','nama_ibu','keterangan'];
    protected $column_order = array(null, null,'nama','nism','nisn','tahun_masuk','nik','kelas_id', 'tgl_lahir', 'tmp_lahir', 'jenkel','anake','jml_saudara','nama_ibu','keterangan', null);
    protected $column_search = array('nism', 'nama');
    protected $order = array('nism' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    //backend
    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table($this->table)->select('*')->join('kelas', 'kelas.kelas_id=santri.kelas_id');
    }
    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if (isset($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $_POST['search']('value'));
                } else {
                    $this->dt->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->dt->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if (isset($_POST['length' != -1]))
            $this->dt->limit($_POST['length'], $_POST['start']);
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }

    public function list()
    {
        return $this->table('santri')
            ->join('kelas', 'kelas.kelas_id = santri.kelas_id')
            ->orderBy('santri_id', 'ASC')
            ->get()->getResultArray();
    }

    public function getkelas()
    {
        return $this->table('santri')
            ->join('kelas', 'kelas.kelas_id = santri.kelas_id')
            ->like('nama_kelas', 'XII')
            ->orderBy('santri_id', 'ASC')
            ->get()->getResultArray();
    }
   
}

