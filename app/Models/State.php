<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
        'state_name',
        'status'
    ];
}
