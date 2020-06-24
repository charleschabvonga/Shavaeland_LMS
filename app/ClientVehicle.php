<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClientVehicle
 *
 * @package App
 * @property string $client
 * @property string $registration_number
 * @property enum $vehicle_type
 * @property string $make
 * @property string $model
 * @property double $starting_mileage
 * @property double $next_service_mileage
 * @property string $next_service_date
 * @property enum $status
*/
class ClientVehicle extends Model
{
    use SoftDeletes;

    protected $fillable = ['registration_number', 'vehicle_type', 'make', 'model', 'starting_mileage', 'next_service_mileage', 'next_service_date', 'status', 'client_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ClientVehicle::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_vehicle_type = ["Truck" => "Truck", "Trailer" => "Trailer", "Bukkie" => "Bukkie", "Horse" => "Horse", "Light" => "Light", "Twin Cab" => "Twin Cab"];

    public static $enum_status = ["Scheduled" => "Scheduled", "Caution" => "Caution", "Due" => "Due", "Done" => "Done"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartingMileageAttribute($input)
    {
        if ($input != '') {
            $this->attributes['starting_mileage'] = $input;
        } else {
            $this->attributes['starting_mileage'] = null;
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
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
}
