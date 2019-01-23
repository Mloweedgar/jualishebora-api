<?php

namespace App\Repositories;

use App\Models\audio;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class audioRepository
 * @package App\Repositories
 * @version December 9, 2018, 6:49 pm UTC
 *
 * @method audio findWithoutFail($id, $columns = ['*'])
 * @method audio find($id, $columns = ['*'])
 * @method audio first($columns = ['*'])
*/
class audioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'audio_url'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return audio::class;
    }
}
