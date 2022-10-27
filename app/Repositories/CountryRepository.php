<?php

namespace App\Repositories;

use App;
use App\Models\Country;

class CountryRepository extends BaseRepository
{
      /**
     * @var array
     */
    protected $fieldSearchable = [
        'country_name','status'
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return Country::class;
    }

}
