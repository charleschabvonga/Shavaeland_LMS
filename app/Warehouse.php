<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Warehouse
 *
 * @package App
 * @property string $vendor
 * @property string $center_name
 * @property double $square_meters
 * @property double $available_space
*/
class Warehouse extends Model
{
    use SoftDeletes;

    protected $fillable = ['center_name', 'square_meters', 'available_space', 'vendor_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Warehouse::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setVendorIdAttribute($input)
    {
        $this->attributes['vendor_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSquareMetersAttribute($input)
    {
        if ($input != '') {
            $this->attributes['square_meters'] = $input;
        } else {
            $this->attributes['square_meters'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setAvailableSpaceAttribute($input)
    {
        if ($input != '') {
            $this->attributes['available_space'] = $input;
        } else {
            $this->attributes['available_space'] = null;
        }
    }

    public function getAvailableSpaceAttribute($input)
    {
        $area = $this->attributes['available_space'];
        foreach($this->receivings as $item){
            $area -= $item->total_area_coverd;
        }
        foreach($this->releasings as $item){
            $area += $item->area_coverd;
        }
        return $area;
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }

    public function receivings() {
        return $this->hasMany(Receiving::class, 'warehouse_id');
    } 
    
    public function releasings() {
        return $this->hasMany(Releasing::class, 'warehouse_id');
    }

    public function received_items() {
        return $this->hasMany(ReceivedItem::class, 'receipt_number_id');
    }

    public function released_items() {
        return $this->hasMany(ReceivedItem::class, 'release_number_id');
    }
}
