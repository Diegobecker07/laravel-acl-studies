<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as Model;

class Permission extends Model
{
    public function getShortNameAttribute()
    {
        return ucfirst(explode('_', $this->attributes['name'])[0]);
    }
}
