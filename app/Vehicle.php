<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vehicle
 *
 * @package App
 * @property enum $vehicle_type
 * @property string $vehicle_description
 * @property string $make
 * @property string $model
 * @property enum $availability
 * @property enum $service_status
 * @property double $starting_mileage
 * @property double $next_service_mileage
 * @property string $next_service_date
 * @property string $chasis_number
 * @property string $engine_number
 * @property string $size
 * @property string $purchase_date
 * @property decimal $purchase_price
 * @property decimal $salvage_value
 * @property decimal $investment
 * @property decimal $depreciation
 * @property decimal $maintenance
 * @property decimal $tyre
*/
class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = ['vehicle_type', 'vehicle_description', 'make', 'model', 'availability', 'service_status', 'starting_mileage', 'next_service_mileage', 'next_service_date', 'chasis_number', 'engine_number', 'size', 'purchase_date', 'purchase_price', 'salvage_value', 'investment', 'depreciation', 'maintenance', 'tyre', 'size_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Vehicle::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_vehicle_type = ["Truck" => "Truck", "Trailer" => "Trailer", "Bukkie" => "Bukkie", "Horse" => "Horse", "Light" => "Light", "Twin Cab" => "Twin Cab"];

    public static $enum_availability = ["Yes" => "Yes", "No(Road Freight)" => "No(Road Freight)", "N0(Workshop)" => "N0(Workshop)"];

    public static $enum_service_status = ["Scheduled" => "Scheduled", "Caution" => "Caution", "Due" => "Due", "Done" => "Done"];

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
     * Set to null if empty
     * @param $input
     */
    public function setSizeIdAttribute($input)
    {
        $this->attributes['size_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPurchaseDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['purchase_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['purchase_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPurchaseDateAttribute($input)
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
    public function setPurchasePriceAttribute($input)
    {
        $this->attributes['purchase_price'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSalvageValueAttribute($input)
    {
        $this->attributes['salvage_value'] = .10*$this->purchase_price;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setInvestmentAttribute($input)
    {
        $this->attributes['investment'] = ($this->purchase_price+$this->salvage_value)/2;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDepreciationAttribute($input)
    {
        $this->attributes['depreciation'] = $input ? $input : null;
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

    public function getDepreciationAttribute(){
        $depreciation = 0;
        foreach($this->machine_costs as $item){
            $depreciation += $item->depreciation;
        }
        return $depreciation;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMaintenanceAttribute($input)
    {
        $this->attributes['maintenance'] = $input ? $input : null;
    }

    public function getMaintenanceAttribute(){
        $maintenance = 0;
        foreach($this->machine_costs as $item){
            $maintenance += $item->repair_maintenance;
        }
        return $maintenance;
    } 

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTyreAttribute($input)
    {
        $this->attributes['tyre'] = $input ? $input : null;
    }

    public function getTyreAttribute(){
        $mileage = 0;
        foreach($this->machine_costs as $item){
            $mileage += $item->tyre;
        }
        return $mileage;
    } 

    public function getMileageAttribute(){
        $mileage = $this->attributes['starting_mileage'];
        foreach($this->machine_costs as $item){
            $mileage += $item->distance;
        }
        return $mileage;
    }   
    
    public function getNetIncomeAttribute(){
        $expense = 0;
        foreach($this->incomes as $item){
            if($item->vehicles  == $this->vehicle_description){
                $expense += $item->road_freight_income;
            }
            
        }
        foreach($this->machine_costs as $item){
            $expense -= $item->total_costs;
        }
        foreach($this->non_machine_costs as $item){
            $expense -= $item->total;
        }
        foreach($this->fuel_costs as $item){
            $expense -= $item->total;
        }
        foreach($this->job_cards as $item){
            $expense -= $item->subtotal;
        }
        foreach($this->violations as $item){
            if ($item->status != 'Driver') {
                $expense -= $item->amount;
            }
        }
        return $expense;
    }

    public function size()
    {
        return $this->belongsTo(MachinerySize::class, 'size_id')->withTrashed();
    }

    public function machine_costs()
    {
        return $this->hasMany(MachineryCost::class, 'vehicle_description_id');
    }  
    
    public function incomes()
    {
        return $this->hasMany(RoadFreight::class, 'project_number_id');
    }

     public function non_machine_costs() {
        return $this->hasMany(NonMachineCost::class, 'road_freight_number_id');
    }

    public function fuel_costs() {
        return $this->hasMany(FuelCost::class, 'road_freight_number_id');
    }

    public function violations() {
        return $this->hasMany(Violation::class, 'vehicle_description_id');
    }

    public function job_cards() {
        return $this->hasMany(JobCard::class, 'vehicle_id');
    }
}
