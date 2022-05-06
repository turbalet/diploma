<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'programs';
    protected $guarded = [];

    public function specialities() {
        return $this->belongsToMany(Speciality::class, 'speciality_program');
    }

    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(University::class, 'university_program');
    }
}
