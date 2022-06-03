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

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function first_subject()
    {
        return $this->belongsTo(Subject::class, 'first_subject');
    }

    public function second_subject()
    {
        return $this->belongsTo(Subject::class, 'second_subject');
    }
}
