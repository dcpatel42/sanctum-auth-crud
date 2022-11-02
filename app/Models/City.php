<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'state_id',
        'city_name',
        'status'
    ];

    /**
     * Get the user that owns the City
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    // get data with filter
    public function scopeSearchCity($query, $filters = [])
    {
        $city = $query;

        if (isset($filters) && !empty($filters)) {
            $city = $city->orderByColumn('id', "ASC");

            if (isset($filters['city_name']) && $filters['city_name'] != '') {
                // filter city_name data from cities.
                $city->where(function ($query) use ($filters) {
                    $query->textSearch($filters['city_name']);
                });
            }
            if (isset($filters['state_name']) && $filters['state_name'] != '') {
                // filter state_name data from states.
                $city->where(function ($query) use ($filters) {
                    $query->stateSearch($filters['state_name']);
                });
            }

            if (isset($filters['status']) && $filters['status'] != '') {
                // filter status data from cities.
                $city->where(function ($query) use ($filters) {
                    $query->Status($filters['status']);
                });
            }
        }
        return $city;
    }
    
    public function ScopeTextSearch($query, $text)
    {
        return  $query->where('city_name', 'LIKE', "%{$text}%");
    }

    public function ScopeStateSearch($query, $text)
    {
        return  $query->orWhereHas('state', function ($q) use ($text) {
                    $q->where('states.state_name', 'LIKE', "%{$text}%");
                });
    }
   
    public function scopeStatus($query,$status)
    {
        return $query->where('status', $status);
    }

    public function ScopeOrderByColumn($query, $sort_column, $sort_type)
    {
        return $query->orderBy($sort_column, $sort_type);
    }
}
