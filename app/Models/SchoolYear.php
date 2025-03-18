<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SchoolYear extends Model
{
    protected $fillable = ['name'];

    /**
     * The semester that belong to the SchoolYear
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semesters(): BelongsToMany
    {
        return $this->belongsToMany(Semester::class, 'sy_sems', 'school_year_id', 'semester_id');
    }
}
