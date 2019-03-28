<?php

namespace Kolpikov\AnnualPremium\Models\Views;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class State
 * @package Kolpikov\AnnualPremium\Models\Views
 */
class State extends Model
{
    /**
     * @var string
     */
    protected $table = 'states_view';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annuals(): HasMany
    {
        return $this->hasMany(AnnualPremium::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRates(Builder $query): Builder
    {
        return $query->orderBy('ann_prem', 'DESC');
    }
}
