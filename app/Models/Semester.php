<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Semester extends Model
{
    protected $fillable = ['name'];

    /**
     * The school years that belong to the Semester
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function schoolYears(): BelongsToMany
    {
        return $this->belongsToMany(SchoolYear::class, 'sy_sems', 'semester_id', 'school_year_id');
    }
}
