<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['name', 'primary', 'secondary', 'text', 'background'];

    protected $hidden = ['created_at', 'updated_at'];
}
