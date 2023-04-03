<?php
namespace App\Validation;
use App\Models\userModel;
class UserRules{
    public function validateUser(string $str, string $field, array $data){
        $model = new userModel();
        $user = $model->where('username', $data['username'])->first();
        if(!$user)
            return false;
        return password_verify($data['password'], $user['password']);
    }
}
?>