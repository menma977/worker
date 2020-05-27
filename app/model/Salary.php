<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Salary
 * @package App\model
 * @property int id
 * @property int salary
 * @property int over_time
 * @property int benefit
 */
class Salary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salary',
        'over_time',
        'benefit'
    ];
}
