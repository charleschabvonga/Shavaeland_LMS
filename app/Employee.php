<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Employee
 *
 * @package App
 * @property string $name
 * @property enum $position
 * @property string $start_date
 * @property string $end_date
 * @property enum $status
 * @property string $street_address
 * @property string $city
 * @property string $province
 * @property string $country
 * @property string $sa_mobile
 * @property string $int_mobile
 * @property string $email
 * @property string $upload_qualifications
 * @property string $upload_identification_docs
*/
class Employee extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['name', 'position', 'start_date', 'end_date', 'status', 'street_address', 'city', 'province', 'country', 'sa_mobile', 'int_mobile', 'email', 'upload_qualifications', 'upload_identification_docs'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Employee::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_position = ["Director" => "Director", "Non Executive Director" => "Non Executive Director", "Administrator" => "Administrator", "Manager" => "Manager", "Supervisor" => "Supervisor", "Driver" => "Driver", "Technician" => "Technician", "General" => "General"];

    public static $enum_status = ["Full-time" => "Full-time", "Part-time" => "Part-time", "Promoted" => "Promoted", "Transfered" => "Transfered", "Resigned" => "Resigned", "Released" => "Released", "Contract Terminated" => "Contract Terminated"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['start_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartDateAttribute($input)
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
    public function setEndDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['end_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['end_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function department()
    {
        return $this->belongsToMany(Department::class, 'department_employee')->withTrashed();
    }
    
    public function qualifications() {
        return $this->hasMany(Qualification::class, 'employee_name_id');
    }
    public function emergency_contacts() {
        return $this->hasMany(EmergencyContact::class, 'employee_name_id');
    }
    public function identifications() {
        return $this->hasMany(Identification::class, 'employee_name_id');
    }
    public function beneficiary_details() {
        return $this->hasMany(BeneficiaryDetail::class, 'employee_name_id');
    }
}
