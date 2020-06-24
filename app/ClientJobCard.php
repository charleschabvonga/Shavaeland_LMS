<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClientJobCard
 *
 * @package App
 * @property string $job_request_number
 * @property string $date
 * @property string $job_card_number
 * @property string $prepared_by
 * @property string $project_number
 * @property string $client
 * @property string $contact_person
 * @property enum $status
 * @property enum $job_type
 * @property string $repair_center
 * @property string $client_vehicle_reg_no
 * @property text $remarks
 * @property text $instructions
 * @property decimal $subtotal
*/
class ClientJobCard extends Model
{
    use SoftDeletes;

    protected $fillable = ['date', 'job_card_number', 'prepared_by', 'status', 'job_type', 'remarks', 'instructions', 'subtotal', 'job_request_number_id', 'project_number_id', 'client_id', 'contact_person_id', 'repair_center_id', 'client_vehicle_reg_no_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ClientJobCard::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Job Ongoing" => "Job Ongoing", "Job Complete" => "Job Complete"];

    public static $enum_job_type = ["Scheduled" => "Scheduled", "Breakdown" => "Breakdown"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setJobRequestNumberIdAttribute($input)
    {
        $this->attributes['job_request_number_id'] = $input ? $input : null;
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
    public function setRepairCenterIdAttribute($input)
    {
        $this->attributes['repair_center_id'] = $input ? $input : null;
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
     * Set attribute to money format
     * @param $input
     */
    public function setSubtotalAttribute($input)
    {
        $this->attributes['subtotal'] = $input ? $input : null;
    }
    
    public function job_request_number()
    {
        return $this->belongsTo(JobRequest::class, 'job_request_number_id')->withTrashed();
    }
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function contact_person()
    {
        return $this->belongsTo(ClientContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function repair_center()
    {
        return $this->belongsTo(Workshop::class, 'repair_center_id')->withTrashed();
    }
    
    public function technician()
    {
        return $this->belongsToMany(Employee::class, 'client_job_card_employee')->withTrashed();
    }
    
    public function client_vehicle_reg_no()
    {
        return $this->belongsTo(JobRequest::class, 'client_vehicle_reg_no_id')->withTrashed();
    }
    
    public function job_card_items() {
        return $this->hasMany(JobCardItem::class, 'client_job_card_number_id');
    }
}
