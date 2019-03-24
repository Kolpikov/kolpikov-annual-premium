<?php

namespace Kolpikov\AnnualPremium\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annuals(): HasMany
    {
        return $this->hasMany(AnnualPremium::class);
    }
}
