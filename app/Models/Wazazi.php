<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Wazazi",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),

 *      @SWG\Property(
 *          property="phone_number",
 *          description="phone_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="first_name",
 *          description="first_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="surname",
 *          description="surname",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="childs_age",
 *          description="childs_age",
 *          type="integer"
 *      )
 * )
 */
class Wazazi extends Model
{
    use SoftDeletes;

    public $table = 'parents';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    public $fillable = [
        'phone_number',
        'first_name',
        'surname',
        'childs_age'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'childs_id' => 'integer',
        'childs_age' => 'string',
        'phone_number' => 'string',
        'first_name' => 'string',
        'surname' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function darasas()
    {
        return $this->hasMany(\App\Models\Darasa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function feedback()
    {
        return $this->hasMany(\App\Models\Feedback::class);
    }
}
