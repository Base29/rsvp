<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'display_name',
        'type',
        'plus_one',
        'guests',
        'notes',
    ];
}