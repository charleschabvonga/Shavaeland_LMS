<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Currency
 *
 * @package App
 * @property string $name
 * @property string $symbol
*/
class Currency extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'symbol'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Currency::observe(new \App\Observers\UserActionsObserver);
    }
    
}
