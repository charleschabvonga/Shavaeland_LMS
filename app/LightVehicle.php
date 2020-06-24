<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LightVehicle
 *
 * @package App
 * @property enum $vehicle_type
 * @property string $vehicle_description
 * @property string $make
 * @property string $model
 * @property string $purchase_date
 * @property decimal $purchase_price
 * @property string $chasis_number
 * @property string $engine_number
 * @property string $size
 * @property double $starting_mileage
 * @property double $next_service_mileage
 * @property string $next_service_date
 * @property enum $service_status
 * @property enum $availability
 * @property decimal $salvage_value
 * @property decimal $investment
 * @property decimal $depreciation
 * @property decimal $maintenance
 * @property decimal $tyre
*/
class LightVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = ['vehicle_type', 'vehicle_description', 'make', 'model', 'purchase_date', 'purchase_price', 'chasis_number', 'engine_number', 'starting_mileage', 'next_service_mileage', 'next_service_date', 'service_status', 'availability', 'salvage_value', 'investment', 'depreciation', 'maintenance', 'tyre', 'size_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        LightVehicle::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_vehicle_type = ["Truck" => "Truck", "Bukkie" => "Bukkie", "Twin Cab" => "Twin Cab", "Light Passenger" => "Light Passenger"];

    public static $enum_service_status = ["Scheduled" => "Scheduled", "Caution" => "Caution", "Due" => "Due", "Done" => "Done"];

    public static $enum_availability = ["Yes" => "Yes", "No(Road Freight)" => "No(Road Freight)", "N0(Workshop)" => "N0(Workshop)"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPurchaseDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['purchase_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['purchase_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPurchaseDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPurchasePriceAttribute($input)
    {
        $this->attributes['purchase_price'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSizeIdAttribute($input)
    {
        $this->attributes['size_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartingMileageAttribute($input)
    {
        if ($input != '') {
            $this->attributes['starting_mileage'] = $input;
        } else {
            $this->attributes['starting_mileage'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setNextServiceMileageAttribute($input)
    {
        if ($input != '') {
            $this->attributes['next_service_mileage'] = $input;
        } else {
            $this->attributes['next_service_mileage'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setNextServiceDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['next_service_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['next_service_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getNextServiceDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSalvageValueAttribute($input)
    {
        $this->attributes['salvage_value'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setInvestmentAttribute($input)
    {
        $this->attributes['investment'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDepreciationAttribute($input)
    {
        $this->attributes['depreciation'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMaintenanceAttribute($input)
    {
        $this->attributes['maintenance'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTyreAttribute($input)
    {
        $this->attributes['tyre'] = $input ? $input : null;
    }
    
    public function size()
    {
        return $this->belongsTo(MachinerySize::class, 'size_id')->withTrashed();
    }
    
}
