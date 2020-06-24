<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class InhouseJobCard
 *
 * @package App
 * @property string $date
 * @property enum $vehicle_type
 * @property string $mileage
 * @property string $job_card_number
 * @property string $prepared_by
 * @property string $project_number
 * @property enum $client_type
 * @property enum $job_card_type
 * @property enum $job_type
 * @property enum $status 
 * @property string $repair_center
 * @property string $workshop_manager
 * @property string $vehicle
 * @property string $trailer
 * @property string $light_vehicles
 * @property string $client_vehicle_reg_no
 * @property string $road_freight_number
 * @property text $remarks
 * @property text $instructions
 * @property decimal $subtotal
*/
class InhouseJobCard extends Model
{
    use SoftDeletes;

    protected $fillable = ['date', 'vehicle_type', 'mileage', 'job_card_number', 'prepared_by', 'client_type', 'job_card_type', 'status', 'job_type', 'remarks', 'instructions', 'subtotal', 'project_number_id', 'repair_center_id', 'workshop_manager_id', 'vehicle_id', 'trailer_id', 'light_vehicles_id', 'client_vehicle_reg_no_id', 'road_freight_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        InhouseJobCard::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_vehicle_type = ["Horse" => "Horse", "Truck" => "Truck", "Trailer" => "Trailer", "Bukkie" => "Bukkie", "Light" => "Light", "Twin Cab" => "Twin Cab"];

    public static $enum_client_type = ["Department" => "Department", "Vendor" => "Vendor"];

    public static $enum_status = ["Job Complete" => "Job Complete", "Job Ongoing" => "Job Ongoing"];

    public static $enum_job_card_type = ["Project" => "Project", "Transaction" => "Transaction"];

    public static $enum_job_type = ["Scheduled" => "Scheduled", "Breakdown" => "Breakdown"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectNumberIdAttribute($input)
    {
        $this->attributes['project_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRepairCenterIdAttribute($input)
    {
        $this->attributes['repair_center_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setWorkshopManagerIdAttribute($input)
    {
        $this->attributes['workshop_manager_id'] = $input ? $input : null;
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
    public function setTrailerIdAttribute($input)
    {
        $this->attributes['trailer_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setLightVehiclesIdAttribute($input)
    {
        $this->attributes['light_vehicles_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientVehicleRegNoIdAttribute($input)
    {
        $this->attributes['client_vehicle_reg_no_id'] = $input ? $input : null;
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
     * Set attribute to money format
     * @param $input
     */
    public function setSubtotalAttribute($input)
    {
        $this->attributes['subtotal'] = $input ? $input : null;
    }
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
    }
    
    public function repair_center()
    {
        return $this->belongsTo(Workshop::class, 'repair_center_id')->withTrashed();
    }

    public function workshop_manager()
    {
        return $this->belongsTo(Employee::class, 'workshop_manager_id')->withTrashed();
    }
    
    public function technician()
    {
        return $this->belongsToMany(Employee::class, 'employee_inhouse_job_card')->withTrashed();
    }
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    
    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id')->withTrashed();
    }
    
    public function light_vehicles()
    {
        return $this->belongsTo(LightVehicle::class, 'light_vehicles_id')->withTrashed();
    }
    
    public function client_vehicle_reg_no()
    {
        return $this->belongsTo(VehicleSc::class, 'client_vehicle_reg_no_id')->withTrashed();
    }
    
    public function road_freight_number()
    {
        return $this->belongsTo(RoadFreight::class, 'road_freight_number_id')->withTrashed();
    }
    
    public function job_card_items() {
        return $this->hasMany(JobCardItem::class, 'job_card_items_id');
    }
}