<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Parameter;

class Aspect extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'aspect_category_id',
        'name',
        'long_name',
    ];

    public function parameters()
    {
        return $this->hasMany(Parameter::class, 'aspect_id', 'id');
    }

    public function getParameterTopAttribute()
    {
        $parameter_value = 0;
        $parameter = $this->parameters()->orderBy('value', 'desc')->first();
        $parameter_value = $parameter->value;

        return $parameter_value;
    }

    public function getParameterBottomAttribute()
    {
        $parameter_value = 0;
        $parameter = $this->parameters()->orderBy('value', 'asc')->first();
        $parameter_value = $parameter->value;

        return $parameter_value;
    }
}
