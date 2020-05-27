<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SalaryList
 * @package App\model
 * @property int id
 * @property int absent_id
 * @property int salary
 * @property int over_time
 * @property int benefit
 * @property int total
 */
class SalaryList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'absent_id',
        'salary',
        'over_time',
        'benefit',
        'total'
    ];
}
