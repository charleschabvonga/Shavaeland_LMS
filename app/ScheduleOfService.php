<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ScheduleOfService
 *
 * @package App
 * @property string $client
 * @property string $job_card_number
 * @property string $vehicle
 * @property string $client_vehicle
 * @property string $description
 * @property double $next_service_mileage
 * @property string $next_service_date
 * @property enum $status
 * @property enum $client_type
 * @property string $schedule_number
*/
class ScheduleOfService extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'next_service_mileage', 'next_service_date', 'status', 'schedule_number', 'client_id', 'job_card_number_id', 'vehicle_id', 'client_vehicle_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ScheduleOfService::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Scheduled" => "Scheduled", "Caution" => "Caution", "Due" => "Due", "Done" => "Done"];

    public static $enum_client_type = ["Customer" => "Customer", "Department" => "Department"];
    
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
    public function setJobCardNumberIdAttribute($input)
    {
        $this->attributes['job_card_number_id'] = $input ? $input : null;
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
    public function setClientVehicleIdAttribute($input)
    {
        $this->attributes['client_vehicle_id'] = $input ? $input : null;
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
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function job_card_number()
    {
        return $this->belongsTo(JobCard::class, 'job_card_number_id')->withTrashed();
    }
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    
    public function client_vehicle()
    {
        return $this->belongsTo(ClientVehicle::class, 'client_vehicle_id')->withTrashed();
    }
    
}
