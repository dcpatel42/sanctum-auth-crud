<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class State extends Model
{
    use HasFactory, SoftDeletes;
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
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get all of the comments for the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class,'state_id','id');
    }
    
    /**
     * Get the user that owns the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
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
    public function scopeSearchState($query, $filters = [])
    {
        $state = $query;

        if (isset($filters) && !empty($filters)) {
            $state = $state->orderByColumn('id', "ASC");

            if (isset($filters['state_name']) && $filters['state_name'] != '') {
                // filter state_name data from state.
                $state->where(function ($query) use ($filters) {
                    $query->textSearch($filters['state_name']);
                });
            }
            if (isset($filters['country_name']) && $filters['country_name'] != '') {
                // filter country_name data from country.
                $state->where(function ($query) use ($filters) {
                    $query->countrySearch($filters['country_name']);
                });
            }

            if (isset($filters['status']) && $filters['status'] != '') {
                // filter status data from state.
                $state->where(function ($query) use ($filters) {
                    $query->Status($filters['status']);
                });
            }
        }
        return $state;
    }
    
    public function ScopeTextSearch($query, $text)
    {
        return  $query->where('state_name', 'LIKE', "%{$text}%");
    }

    public function ScopeCountrySearch($query, $text)
    {
        return  $query->orWhereHas('country', function ($q) use ($text) {
                    $q->where('countries.country_name', 'LIKE', "%{$text}%");
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
