<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'id';

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'country_name',
        'status'
    ];
    
    /**
     * Get all of the comments for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        return $this->hasMany(State::class,'country_id','id');
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

    public function ScopeOrderByColumn($query, $sort_column, $sort_type)
    {
        return $query->orderBy($sort_column, $sort_type);
    }

    // get data with filter
    public function scopeSearchCountry($query, $filters = [])
    {
        $country = $query;

        if (isset($filters) && !empty($filters)) {
            $country = $country->orderByColumn('country_name', "ASC");

            if (isset($filters['country_name']) && $filters['country_name'] != '') {
                // filter country_name data from country.
                $country->where(function ($query) use ($filters) {
                    $query->textSearch($filters['country_name']);
                });
            }

            if (isset($filters['status']) && $filters['status'] != '') {
                // filter status data from country.
                $country->where(function ($query) use ($filters) {
                    $query->Status($filters['status']);
                });
            }
        }
        return $country;
    }
    
    
    public function ScopeTextSearch($query, $text)
    {
        return $query->where('country_name', 'LIKE', "%{$text}%");
    }
   
    public function scopeStatus($query,$status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get all of the comments for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }
}
