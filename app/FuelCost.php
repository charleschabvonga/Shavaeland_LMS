<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FuelCost
 *
 * @package App
 * @property string $receipt_number
 * @property string $road_freight_number
 * @property string $vehicle
 * @property string $description
 * @property double $qty
 * @property decimal $cost
 * @property decimal $total
*/
class FuelCost extends Model
{
    use SoftDeletes;

    protected $fillable = ['receipt_number', 'description', 'qty', 'cost', 'total', 'road_freight_number_id', 'vehicle_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        FuelCost::observe(new \App\Observers\UserActionsObserver);
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
     * Set to null if empty
     * @param $input
     */
    public function setVehicleIdAttribute($input)
    {
        $this->attributes['vehicle_id'] = $input ? $input : null;
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
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    
}
