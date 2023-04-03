<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\userModel;

class komentarModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'komentar';
    protected $primaryKey           = 'cid';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['cid', 'uid', 'isi', 'aid'];

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

    public function getKomentar(Int $id)
    {   
        $user = new userModel();
        $hasil = array();
        $komentar = $this->getwhere(['aid' => $id])->getResult();
        foreach ($komentar as $komen) {
            $temp = [
                'username' => $user->getUsername($komen->uid),
                'komentar' => $komen->isi,
            ];
            array_push($hasil, $temp);
        }
        return $hasil;
    }
    public function insertKomentar($data)
    {
        return $this->insert($data);
    }
}
