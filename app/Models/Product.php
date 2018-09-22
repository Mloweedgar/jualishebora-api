<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Product",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="teacher_id",
 *          description="teacher_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="image_id",
 *          description="image_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      )
 * )
 */
class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'price',
        'teacher_id',
        'image_id',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'string',
        'teacher_id' => 'integer',
        'image_id' => 'integer',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function teacher()
    {
        return $this->belongsTo(\App\Models\Teacher::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function image()
    {
        return $this->belongsTo(\App\Models\Image::class);
    }
}
