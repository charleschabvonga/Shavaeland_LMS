<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NonMachineCost
 *
 * @package App
 * @property string $road_freight_number
 * @property string $item_description
 * @property double $qty
 * @property decimal $cost
 * @property decimal $total
*/
class NonMachineCost extends Model
{
    use SoftDeletes;

    protected $fillable = ['item_description', 'qty', 'cost', 'total', 'road_freight_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        NonMachineCost::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoadFreightNumberIdAttribute($input)
    {
        $this->attributes['road_freight_number_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setQtyAttribute($input)
    {
        if ($input != '') {
            $this->attributes['qty'] = $input;
        } else {
            $this->attributes['qty'] = null;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCostAttribute($input)
    {
        $this->attributes['cost'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalAttribute($input)
    {
        $this->attributes['total'] = $input ? $input : null;
    }
    
    public function road_freight_number()
    {
        return $this->belongsTo(RoadFreight::class, 'road_freight_number_id')->withTrashed();
    }
    
}
