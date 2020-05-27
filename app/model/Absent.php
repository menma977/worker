<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Absent
 * @package App\model
 * @property int id
 * @property int user_id
 * @property string on
 * @property string off
 * @property string over_time
 */
class Absent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'on',
        'off',
        'over_time'
    ];
}
