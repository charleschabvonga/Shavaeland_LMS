<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Identification
 *
 * @package App
 * @property string $employee_name
 * @property string $id_type
 * @property string $id_number
 * @property string $date_of_birth
 * @property string $date_obtained
 * @property string $expiry_date
*/
class Identification extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['id_type', 'id_number', 'date_of_birth', 'date_obtained', 'expiry_date', 'employee_name_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Identification::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEmployeeNameIdAttribute($input)
    {
        $this->attributes['employee_name_id'] = $input ? $input : null;
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
    public function setDateObtainedAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date_obtained'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date_obtained'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateObtainedAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function employee_name()
    {
        return $this->belongsTo(Employee::class, 'employee_name_id')->withTrashed();
    }
    
}
