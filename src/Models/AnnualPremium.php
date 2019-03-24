<?php

namespace Kolpikov\AnnualPremium\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
