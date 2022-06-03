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
    protected $hidden = ['degree_id'];
    protected $guarded = [];

    public function specialities() {
        return $this->belongsToMany(Speciality::class, 'speciality_program');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function first_subject()
    {
        return $this->belongsTo(Subject::class, 'first_subject');
    }

    public function second_subject()
    {
        return $this->belongsTo(Subject::class, 'second_subject');
    }

    public function universities(): BelongsToMany
    {
        return $this->belongsToMany(University::class, 'university_program');
    }
}
