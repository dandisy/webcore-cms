<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models
 * @version December 7, 2017, 3:30 pm UTC
 *
 * @property string title
 * @property string slug
 * @property string content
 * @property string tag
 * @property integer category
 * @property string cover
 * @property string status
 */
class Post extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'slug',
        'content',
        'tag',
        'category',
        'cover',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'content' => 'string',
        'tag' => 'string',
        'category' => 'integer',
        'cover' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'slug' => 'required',
        'content' => 'required',
        'category' => 'required',
        'status' => 'required'
    ];

    
}
