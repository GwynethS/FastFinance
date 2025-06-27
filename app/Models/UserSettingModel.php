<?php namespace App\Models;

use CodeIgniter\Model;

class UserSettingModel extends Model{
    protected $table      = 'user_setting';
    protected $allowedFields = [
        'user_id',
        'coin',
        'interest_rate_type',
        'annuity_type',
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