<?php

namespace Kolpikov\AnnualPremium\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * Class AnnualPremium
 * @package Kolpikov\AnnualPremium\Models
 */
class AnnualPremium extends Model
{
    /**
     * @var string
     */
    protected $table = 'annual_premiums';

    /**
     * @var array
     */
    protected $fillable = [
        'state_id',
        'gender_id',
        'zipcode',
        'min_ann_prem',
        'max_ann_prem',
        'age',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRates(Builder $query): Builder
    {
        return $query->select([
            'annual_premiums.age',
            'annual_premiums.gender_id',
            DB::raw('ROUND(AVG(min_ann_prem),2) as min_ann_prem'),
            DB::raw('ROUND(AVG(max_ann_prem),2) as max_ann_prem'),
            DB::raw('ROUND(AVG((min_ann_prem + max_ann_prem) / 2),2) as avg_ann_prem'),
        ])->groupBy('age', 'gender_id')->orderBy('gender_id');
    }
}
