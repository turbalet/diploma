<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function universities() {
        return $this->belongsToMany(University::class, 'university_speciality');
    }
}
