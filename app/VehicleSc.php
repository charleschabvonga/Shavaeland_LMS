<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class VehicleSc
 *
 * @package App
 * @property string $vendor
 * @property string $subcontractor_number
 * @property enum $vehicle_type
 * @property enum $status
 * @property string $make
 * @property string $model
 * @property string $registration_number
 * @property string $certificate_of_registration
 * @property string $certificate_of_fitness_number
 * @property string $certificate_of_fitness
 * @property string $tracker_pin_details
 * @property string $tracker_password
 * @property string $expiration_date
 * @property string $service_history_reports
*/
class VehicleSc extends Model
{
    use SoftDeletes;

    protected $fillable = ['vehicle_type',  'status', 'make', 'model', 'registration_number', 'certificate_of_registration', 'certificate_of_fitness_number', 'certificate_of_fitness', 'tracker_pin_details', 'tracker_password', 'expiration_date', 'service_history_reports', 'vendor_id', 'subcontractor_number_id'];
    protected $hidden = ['tracker_password'];
    
    
    public static function boot()
    {
        parent::boot();

        VehicleSc::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_vehicle_type = ["Truck" => "Truck", "Trailer" => "Trailer", "Bukkie" => "Bukkie", "Horse" => "Horse", "Light" => "Light", "Twin Cab" => "Twin Cab"];
    public static $enum_status = ["Up to date" => "Up to date", "COF expired" => "COF expired"];

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
    public function setSubcontractorNumberIdAttribute($input)
    {
        $this->attributes['subcontractor_number_id'] = $input ? $input : null;
    }/**
     * Hash password
     * @param $input
     */
    public function setTrackerPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['tracker_password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setExpirationDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['expiration_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['expiration_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getExpirationDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function subcontractor_number()
    {
        return $this->belongsTo(RoadFreightSubContractor::class, 'subcontractor_number_id')->withTrashed();
    }
    
}
