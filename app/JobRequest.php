<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class JobRequest
 *
 * @package App
 * @property string $project_number
 * @property text $description
 * @property string $workshop_manager
 * @property string $job_request_number
 * @property string $requested_by
 * @property string $client
 * @property string $contact_person
 * @property string $date
 * @property enum $vehicle_type
 * @property string $vehicle_registration_number
 * @property string $make
 * @property string $model
 * @property string $mileage
 * @property double $next_service_mileage
 * @property string $next_service_date
 * @property enum $status
*/
class JobRequest extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'job_request_number', 'requested_by', 'date', 'vehicle_type', 'vehicle_registration_number', 'make', 'model', 'mileage', 'next_service_mileage', 'next_service_date', 'status', 'project_number_id', 'workshop_manager_id', 'client_id', 'contact_person_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        JobRequest::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_vehicle_type = ["Horse" => "Horse", "Truck" => "Truck", "Trailer" => "Trailer", "Bukkie" => "Bukkie", "Light" => "Light", "Twin Cab" => "Twin Cab"];

    public static $enum_status = ["Open" => "Open", "Closed" => "Closed"];

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
    public function setWorkshopManagerIdAttribute($input)
    {
        $this->attributes['workshop_manager_id'] = $input ? $input : null;
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
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
    }
    
    public function workshop_manager()
    {
        return $this->belongsTo(Employee::class, 'workshop_manager_id')->withTrashed();
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function contact_person()
    {
        return $this->belongsTo(ClientContact::class, 'contact_person_id')->withTrashed();
    }
    
}
