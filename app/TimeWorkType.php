<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeWorkType
 *
 * @package App
 * @property string $name
*/
class TimeWorkType extends Model
{
    protected $fillable = ['name'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        TimeWorkType::observe(new \App\Observers\UserActionsObserver);
    }
    
}
