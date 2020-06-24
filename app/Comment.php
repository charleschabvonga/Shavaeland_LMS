<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property text $comments
*/
class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'comments'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Comment::observe(new \App\Observers\UserActionsObserver);
    }
    
}
