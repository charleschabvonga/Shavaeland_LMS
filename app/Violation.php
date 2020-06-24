<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Violation
 *
 * @package App
 * @property string $employee_name
 * @property string $vehicle_description
 * @property string $trailer
 * @property string $road_freight_number
 * @property string $citation_number
 * @property string $citation_date
 * @property string $description
 * @property string $location_issued
 * @property string $file
 * @property enum $status
 * @property decimal $amount
*/
class Violation extends Model
{
    use SoftDeletes;

    protected $fillable = ['citation_number', 'citation_date', 'description', 'file', 'status', 'amount', 'location_issued_address', 'location_issued_latitude', 'location_issued_longitude', 'employee_name_id', 'vehicle_description_id', 'trailer_id', 'road_freight_number_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Violation::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_status = ["Driver" => "Driver", "Operations" => "Operations", "Workshop" => "Workshop"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEmployeeNameIdAttribute($input)
    {
        $this->attributes['employee_name_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setVehicleDescriptionIdAttribute($input)
    {
        $this->attributes['vehicle_description_id'] = $input ? $input : null;
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
    public function setRoadFreightNumberIdAttribute($input)
    {
        $this->attributes['road_freight_number_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setCitationDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['citation_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['citation_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getCitationDateAttribute($input)
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
    public function setAmountAttribute($input)
    {
        $this->attributes['amount'] = $input ? $input : null;
    }
    
    public function employee_name()
    {
        return $this->belongsTo(Employee::class, 'employee_name_id')->withTrashed();
    }
    
    public function vehicle_description()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_description_id')->withTrashed();
    }
    
    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id')->withTrashed();
    }
    
    public function road_freight_number()
    {
        return $this->belongsTo(RoadFreight::class, 'road_freight_number_id')->withTrashed();
    }
    
}
