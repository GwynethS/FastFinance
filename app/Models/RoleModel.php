<?php namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model{
    protected $table      = 'role';
    protected $allowedFields = [
        'name',
        'alias',
        'state',
        'created_by',
        'created_at',
        'edited_by',
        'edited_at'
    ];
    protected $primaryKey = 'id';

    protected $beforeInsert = [];
    protected $beforeUpdate = [];
}