<?php

namespace Kolpikov\AnnualPremium\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gender
 * @package Kolpikov\AnnualPremium\Models
 */
class Gender extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
