<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SySem extends Model
{
    protected $guarded = [];

    /**
     * Get the school_year that owns the SySem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school_year(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id', 'id');
    }

    /**
     * Get the semester that owns the SySem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }
}
