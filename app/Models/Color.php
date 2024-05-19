<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public $timestamps = false;

    // TODO: Change semantic to description and add FK
    protected $fillable = ['name', 'semantic', 'supervisor_id'];
}
