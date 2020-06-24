<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OperationType
 *
 * @package App
 * @property string $name
*/
class OperationType extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        OperationType::observe(new \App\Observers\UserActionsObserver);
    }
    
}
