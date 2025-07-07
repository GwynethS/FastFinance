<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table      = 'user';
    protected $allowedFields = [
        'role_id',
        'username',
        'email',
        'password',
        'state',
        'created_by',
        'created_at',
        'edited_by',
        'edited_at'
    ];
    protected $primaryKey = 'id';

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data){
        if (!isset($data['data']['password'])){
            return $data;
        } 
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    
        return $data;        
    }
}