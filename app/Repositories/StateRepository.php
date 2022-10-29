<?php

namespace App\Repositories;

use App;
use App\Models\State;

class StateRepository extends BaseRepository
{
      /**
     * @var array
     */
    protected $fieldSearchable = [
        'country_id','state_name','status'
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
        return State::class;
    }

}
