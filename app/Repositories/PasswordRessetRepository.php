<?php

namespace App\Repositories;

use App\Models\PasswordResset;
use InfyOm\Generator\Common\BaseRepository;

class PasswordRessetRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PasswordResset::class;
    }
}
