<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class University extends Model
{
    use HasFactory;
    protected $table = 'universities';
    protected $guarded = [];
    protected $hidden = ['region_id', 'category_id', 'type_id', 'language_id'];
    public $timestamps = false;

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function specialities(): BelongsToMany
    {
        return $this->belongsToMany(Speciality::class, 'university_speciality');
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'university_program');
    }
}
