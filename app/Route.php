<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Route
 *
 * @package App
 * @property string $route
 * @property double $distance
*/
class Route extends Model
{
    use SoftDeletes;

    protected $fillable = ['route', 'distance'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Route::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDistanceAttribute($input)
    {
        if ($input != '') {
            $this->attributes['distance'] = $input;
        } else {
            $this->attributes['distance'] = null;
        }
    }
    
}
