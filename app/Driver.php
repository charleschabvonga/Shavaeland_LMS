<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Driver
 *
 * @package App
 * @property string $vendor
 * @property string $subcontractor_number
 * @property string $name
 * @property string $date_of_birth
 * @property string $drivers_license_number
 * @property string $drivers_license
 * @property string $drivers_license_expiry_date
 * @property string $int_drivers_license_no
 * @property string $int_drivers_license
 * @property string $int_drivers_license_expiry_date
 * @property string $drivers_passport_number
 * @property string $drivers_passport
 * @property string $passport_expiry_date
 * @property string $sa_phone_number
 * @property string $int_phone_number
 * @property string $police_clearance_expiry_date
 * @property string $police_clearance
 * @property string $retest_number
 * @property string $retest
 * @property string $retest_expiry_date
 * @property enum $status
*/
class Driver extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'date_of_birth', 'drivers_license_number', 'drivers_license', 'drivers_license_expiry_date', 'int_drivers_license_no', 'int_drivers_license', 'int_drivers_license_expiry_date', 'drivers_passport_number', 'drivers_passport', 'passport_expiry_date', 'sa_phone_number', 'int_phone_number', 'police_clearance_expiry_date', 'police_clearance', 'retest_number', 'retest', 'retest_expiry_date', 'status', 'vendor_id', 'subcontractor_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Driver::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Up to date" => "Up to date", "License expired" => "License expired", "Int license expired" => "Int license expired", "Passport expired" => "Passport expired", "Retest expired" => "Retest expired", "Police clearance expired" => "Police clearance expired"];

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
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateOfBirthAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date_of_birth'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date_of_birth'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateOfBirthAttribute($input)
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
    public function setDriversLicenseExpiryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['drivers_license_expiry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['drivers_license_expiry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDriversLicenseExpiryDateAttribute($input)
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
    public function setIntDriversLicenseExpiryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['int_drivers_license_expiry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['int_drivers_license_expiry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getIntDriversLicenseExpiryDateAttribute($input)
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
    public function setPassportExpiryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['passport_expiry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['passport_expiry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPassportExpiryDateAttribute($input)
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
    public function setPoliceClearanceExpiryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['police_clearance_expiry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['police_clearance_expiry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPoliceClearanceExpiryDateAttribute($input)
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
    public function setRetestExpiryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['retest_expiry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['retest_expiry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getRetestExpiryDateAttribute($input)
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
