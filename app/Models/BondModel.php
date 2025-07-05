<?php namespace App\Models;

use CodeIgniter\Model;

class BondModel extends Model
{
    protected $table = 'bond';
    protected $allowedFields = [
        'user_id',
        'code',
        'name',
        'coin',
        'face_value',
        'market_value',
        'interest_rate_type',
        'capitalization_period',
        'interest_rate',
        'cok',
        'term_years',
        'payment_frequency',
        'year_days',
        'total_grace',
        'partial_grace',
        'issue_date',
        'premium',
        'structuring_fee',
        'placement_fee',
        'floatation_fee',
        'cavali_fee',
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