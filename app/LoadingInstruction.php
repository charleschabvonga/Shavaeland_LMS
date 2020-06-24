<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LoadingInstruction
 *
 * @package App
 * @property string $road_freight_number
 * @property enum $freight_contract_type
 * @property string $loading_instruction_number
 * @property string $driver
 * @property string $vehicle
 * @property string $vendor
 * @property string $vendor_driver
 * @property string $order_number
 * @property string $client
 * @property string $contact_person
 * @property string $project_manager
 * @property string $pick_up_company_name
 * @property string $pickup_address
 * @property string $pickup_date_time
 * @property string $prepared_by
 * @property enum $status
*/
class LoadingInstruction extends Model
{
    use SoftDeletes;

    protected $fillable = ['freight_contract_type', 'loading_instruction_number', 'order_number', 'pick_up_company_name', 'pickup_date_time', 'prepared_by', 'status', 'pickup_address_address', 'pickup_address_latitude', 'pickup_address_longitude', 'road_freight_number_id', 'driver_id', 'vehicle_id', 'vendor_id', 'vendor_driver_id', 'client_id', 'contact_person_id', 'project_manager_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        LoadingInstruction::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_freight_contract_type = ["Shavaeland" => "Shavaeland", "Subcontractor" => "Subcontractor"];

    public static $enum_status = ["Draft" => "Draft", "Loaded" => "Loaded", "Delivered" => "Delivered"];

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
    public function setDriverIdAttribute($input)
    {
        $this->attributes['driver_id'] = $input ? $input : null;
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
     * Set to null if empty
     * @param $input
     */
    public function setVendorIdAttribute($input)
    {
        $this->attributes['vendor_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setVendorDriverIdAttribute($input)
    {
        $this->attributes['vendor_driver_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setContactPersonIdAttribute($input)
    {
        $this->attributes['contact_person_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectManagerIdAttribute($input)
    {
        $this->attributes['project_manager_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPickupDateTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['pickup_date_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['pickup_date_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPickupDateTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }
    
    public function road_freight_number()
    {
        return $this->belongsTo(RoadFreight::class, 'road_freight_number_id')->withTrashed();
    }
    
    public function driver()
    {
        return $this->belongsTo(Employee::class, 'driver_id')->withTrashed();
    }
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    
    public function trailers()
    {
        return $this->belongsToMany(Trailer::class, 'loading_instruction_trailer')->withTrashed();
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function vendor_driver()
    {
        return $this->belongsTo(Driver::class, 'vendor_driver_id')->withTrashed();
    }
    
    public function vendor_vehicle_description()
    {
        return $this->belongsToMany(VehicleSc::class, 'loading_instruction_vehicle_sc')->withTrashed();
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function contact_person()
    {
        return $this->belongsTo(ClientContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function project_manager()
    {
        return $this->belongsTo(Employee::class, 'project_manager_id')->withTrashed();
    }
    
    public function loading_requirements() {
        return $this->hasMany(LoadingRequirement::class, 'loading_instruction_number_id');
    }
    public function load_descriptions() {
        return $this->hasMany(LoadDescription::class, 'loading_instruction_number_id');
    }
}
