<?php

namespace App\Repositories;

use App\Models\Wazazi;
use InfyOm\Generator\Common\BaseRepository;

class WazaziRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'childs_id',
        'phone_number',
        'first_name',
        'middle_name',
        'last_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Wazazi::class;
    }
}
