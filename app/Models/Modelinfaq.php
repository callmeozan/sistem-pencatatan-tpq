<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Modelinfaq extends Model
{
    protected $table      = 'infaq';
    protected $primaryKey = 'infaq_id';
    protected $allowedFields = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'santri_id'];
    protected $column_order = array('nis', 'nama', 'nama_kelas',);
    protected $column_search = array('nis', 'nama', 'nama_kelas');
    protected $order = array('infaq_id' => 'asc');
    protected $request;
    protected $db;
    protected $dt;
    //backend
    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table('infaq')->select('*')
            ->join('santri', 'santri.santri_id = infaq.santri_id')
            ->join('kelas', 'kelas.kelas_id = santri.kelas_id');
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
        return $this->table('infaq')
            ->orderBy('infaq_id', 'ASC')
            ->get()->getResultArray();
    }

    public function listjoin()
    {
        return $this->table('infaq')
            ->join('santri', 'santri.santri_id = infaq.santri_id')
            ->join('kelas', 'kelas.kelas_id = santri.kelas_id')
            ->orderBy('infaq_id', 'ASC')
            ->get()->getResultArray();
    }

    //frontend

    public function get_infaq_keyword($keyword)
    {
        return $this->table('infaq')
            ->select('*')
            ->join('santri', 'santri.santri_id = infaq.santri_id')
            ->join('kelas', 'kelas.kelas_id = santri.kelas_id')
            ->where('nis', $keyword)
            ->groupBy('santri.santri_id')
            ->orderBy('nis', 'ASC')
            ->get()->getResultArray();
    }

    public function search_infaq($keyword)
    {
        return $this->table('infaq')
            ->join('santri', 'santri.santri_id = infaq.santri_id')
            ->like('nis', $keyword)
            ->orderBy('nis', 'ASC')
            ->get()->getResultArray();
    }
}
