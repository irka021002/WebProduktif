<?php

namespace App\Models;

use CodeIgniter\Model;

class artikelModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'artikel';
    protected $primaryKey           = 'aid';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['judul', 'isi'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getArtikel($id = false)
    {
        if ($id === false)
        {
            return $this->findAll();
        }else{
            return $this->getwhere(['aid' => $id])->getResult();
        }
    }

    public function insertArtikel($data)
    {
        return $this->insert($data);
    }

    public function deleteArtikel($id)
    {
        return $this->delete(array("aid" => $id));
    }

    public function editArtikel($data, $id)
    {
        return $this->update($id, $data);
    }
}
