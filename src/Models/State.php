<?php

namespace Kolpikov\AnnualPremium\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class State
 * @package Kolpikov\AnnualPremium\Models
 */
class State extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annuals(): HasMany
    {
        return $this->hasMany(AnnualPremium::class);
    }
}
