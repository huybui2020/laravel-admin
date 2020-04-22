<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['post_cateid', 'post_title', 'post_teaser', 'post_content', 'post_image', 'post_imgdesc'];

    public function posts()
    {
        return $this->belongsTo('App\Post');
    }
    
}
