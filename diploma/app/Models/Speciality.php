<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speciality extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(University::class, 'university_speciality');
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'speciality_program');
    }
}
