<?php

namespace Kolpikov\AnnualPremium\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRates(Builder $query): Builder
    {
        $subQuery = "ROUND((SELECT AVG((min_ann_prem + max_ann_prem) / 2) from annual_premiums
         WHERE state_id = states.id), 2) as ann_prem";

        return $query->select([
            'states.*',
            DB::raw($subQuery),
        ])->orderBy('ann_prem', 'DESC');
    }
}
