<?php

namespace Kolpikov\AnnualPremium\Models\Views;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kolpikov\AnnualPremium\Models\Gender;

/**
 * Class AnnualPremium
 * @package Kolpikov\AnnualPremium\Models\Views
 */
class AnnualPremium extends Model
{
    /**
     * @var string
     */
    protected $table = 'annual_premiums_view';

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
        return $query->orderBy('gender_id');
    }
}
