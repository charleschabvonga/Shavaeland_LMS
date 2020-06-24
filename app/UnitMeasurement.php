<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UnitMeasurement
 *
 * @package App
 * @property string $measurement_type
*/
class UnitMeasurement extends Model
{
    use SoftDeletes;

    protected $fillable = ['measurement_type'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        UnitMeasurement::observe(new \App\Observers\UserActionsObserver);
    }
    
}
