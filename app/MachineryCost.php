<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MachineryCost
 *
 * @package App
 * @property string $road_freight_number
 * @property enum $load_status
 * @property enum $attachment_type
 * @property string vehicle_description
 * @property string $route
 * @property string $distance
 * @property string $truck_attachment_status
 * @property string $machinery_attachment_type
 * @property string $size
 * @property decimal $purchase_price
 * @property decimal $salvage_value
 * @property decimal $avg_investment
 * @property decimal $depreciation
 * @property decimal $insurance
 * @property decimal $license
 * @property decimal $fuel_price
 * @property double $fuel_usage
 * @property decimal $fuel
 * @property double $fuel_consumption
 * @property decimal $oil_price
 * @property double $oil_usage
 * @property decimal $oil
 * @property double $oil_consumption
 * @property decimal $tyre_price
 * @property decimal $number_of_tyres
 * @property decimal $tyre
 * @property decimal $repair_maintenance
 * @property decimal $contigency_factor
 * @property decimal $total_costs
*/
class MachineryCost extends Model
{
    use SoftDeletes;

    protected $fillable = ['road_freight_number_id', 'route_id', 'distance', 'load_status', 'attachment_type', 'truck_attachment_status_id', 'machinery_attachment_type_id', 'size_id', 'vehicle_description_id', 'purchase_price', 'fuel_usage', 'salvage_value', 'avg_investment', 'depreciation', 'insurance', 'license', 'fuel_price', 'fuel_usage', 'fuel', 'fuel_consumption', 'oil_price', 'oil_usage', 'oil', 'oil_consumption', 'tyre_price', 'number_of_tyres', 'tyre', 'repair_maintenance', 'contigency_factor', 'total_costs'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        MachineryCost::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_load_status = ["Empty" => "Empty", "Loaded" => "Loaded"];
    public static $enum_attachment_type = ["Tri axle" => "Tri axle", "Link" => "Link", "Rigid" => "Rigid"];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRoadFreightNumberIdAttribute($input)
    {
        $this->attributes['road_freight_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setRouteIdAttribute($input)
    {
        $this->attributes['route_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDistanceAttribute($input)
    {
        //$this->attributes['distance'] = $input ? $input : null;

        if ($this->attributes['route_id'] == 1) {
            $this->attributes['distance'] = 1124.7 + 100;
        }
        else if ($this->attributes['route_id'] == 2) {
            $this->attributes['distance'] = 863 + 100;
        }
        else if ($this->attributes['route_id'] == 3) {
            $this->attributes['distance'] = 818.22 + 100;
        }
        else if ($this->attributes['route_id'] == 4) {
            $this->attributes['distance'] = 1577.4 + 100;
        }
        else if ($this->attributes['route_id'] == 5) {
            $this->attributes['distance'] = 1887.3 + 100;
        }
        else if ($this->attributes['route_id'] == 6) {
            $this->attributes['distance'] = 544.5 + 100;
        }
        else if ($this->attributes['route_id'] == 7) {
            $this->attributes['distance'] = 1343.1 + 100;
        }
        else if ($this->attributes['route_id'] == 8) {
            $this->attributes['distance'] = 567.6 + 100;
        }
        else if ($this->attributes['route_id'] == 9) {
            $this->attributes['distance'] = 1123.5 + 100;
        }
        else if ($this->attributes['route_id'] == 10) {
            $this->attributes['distance'] = 434.8 + 100;
        }
        else if ($this->attributes['route_id'] == 11) {
            $this->attributes['distance'] = 386.3 + 100;
        }
        else if ($this->attributes['route_id'] == 12) {
            $this->attributes['distance'] = 495.2 + 100;
        }
        else if ($this->attributes['route_id'] == 13) {
            $this->attributes['distance'] = 805.1 + 100;
        }
        else if ($this->attributes['route_id'] == 14) {
            $this->attributes['distance'] = 1137.2 + 100;
        }
        else if ($this->attributes['route_id'] == 15) {
            $this->attributes['distance'] = 575.9 + 100;
        }
        else if ($this->attributes['route_id'] == 16) {
            $this->attributes['distance'] = 1679.6 + 100;
        }
        else if ($this->attributes['route_id'] == 17) {
            $this->attributes['distance'] = 863 + 100;
        }
        else if ($this->attributes['route_id'] == 18) {
            $this->attributes['distance'] = 434.8 + 100;
        }
        else if ($this->attributes['route_id'] == 19) {
            $this->attributes['distance'] = 182.5 + 100;
        }
        else if ($this->attributes['route_id'] == 20) {
            $this->attributes['distance'] = 795 + 100;
        }
        else if ($this->attributes['route_id'] == 21) {
            $this->attributes['distance'] = 1104.8 + 100;
        }
        else if ($this->attributes['route_id'] == 22) {
            $this->attributes['distance'] = 1021.3 + 100;
        }
        else if ($this->attributes['route_id'] == 23) {
            $this->attributes['distance'] = 869.5 + 100;
        }
        else if ($this->attributes['route_id'] == 24) {
            $this->attributes['distance'] = 1417.7 + 100;
        }
        else if ($this->attributes['route_id'] == 25) {
            $this->attributes['distance'] = 818.22 + 100;
        }
        else if ($this->attributes['route_id'] == 26) {
            $this->attributes['distance'] = 386.3 + 100;
        }
        else if ($this->attributes['route_id'] == 27) {
            $this->attributes['distance'] = 182.5 + 100;
        }
        else if ($this->attributes['route_id'] == 28) {
            $this->attributes['distance'] = 755.6 + 100;
        }
        else if ($this->attributes['route_id'] == 29) {
            $this->attributes['distance'] = 1065.5 + 100;
        }
        else if ($this->attributes['route_id'] == 30) {
            $this->attributes['distance'] = 882.3 + 100;
        }
        else if ($this->attributes['route_id'] == 31) {
            $this->attributes['distance'] = 687.5 + 100;
        }
        else if ($this->attributes['route_id'] == 32) {
            $this->attributes['distance'] = 1381.1 + 100;
        }
        else if ($this->attributes['route_id'] == 33) {
            $this->attributes['distance'] = 1577.4 + 100;
        }
        else if ($this->attributes['route_id'] == 34) {
            $this->attributes['distance'] = 495.2 + 100;
        }
        else if ($this->attributes['route_id'] == 35) {
            $this->attributes['distance'] = 795 + 100;
        }
        else if ($this->attributes['route_id'] == 36) {
            $this->attributes['distance'] = 755.6 + 100;
        }
        else if ($this->attributes['route_id'] == 37) {
            $this->attributes['distance'] = 316.9 + 100;
        }
        else if ($this->attributes['route_id'] == 38) {
            $this->attributes['distance'] = 1584.2 + 100;
        }
        else if ($this->attributes['route_id'] == 39) {
            $this->attributes['distance'] = 1071.2 + 100;
        }
        else if ($this->attributes['route_id'] == 40) {
            $this->attributes['distance'] = 2133.2 + 100;
        }
        else if ($this->attributes['route_id'] == 41) {
            $this->attributes['distance'] = 1887.3 + 100;
        }
        else if ($this->attributes['route_id'] == 42) {
            $this->attributes['distance'] = 805.1 + 100;
        }
        else if ($this->attributes['route_id'] == 43) {
            $this->attributes['distance'] = 1104.8 + 100;
        }
        else if ($this->attributes['route_id'] == 44) {
            $this->attributes['distance'] = 1065.5 + 100;
        }
        else if ($this->attributes['route_id'] == 45) {
            $this->attributes['distance'] = 316.9 + 100;
        }
        else if ($this->attributes['route_id'] == 46) {
            $this->attributes['distance'] = 1892.7 + 100;
        }
        else if ($this->attributes['route_id'] == 47) {
            $this->attributes['distance'] = 1379.7 + 100;
        }
        else if ($this->attributes['route_id'] == 48) {
            $this->attributes['distance'] = 2442 + 100;
        }
         else if ($this->attributes['route_id'] == 49) {
            $this->attributes['distance'] = 544.5 + 100;
        }
        else if ($this->attributes['route_id'] == 50) {
            $this->attributes['distance'] = 1137.2 + 100;
        }
        else if ($this->attributes['route_id'] == 51) {
            $this->attributes['distance'] = 1021.3 + 100;
        }
        else if ($this->attributes['route_id'] == 52) {
            $this->attributes['distance'] = 882.3 + 100;
        }
        else if ($this->attributes['route_id'] == 53) {
            $this->attributes['distance'] = 1584.2 + 100;
        }
        else if ($this->attributes['route_id'] == 54) {
            $this->attributes['distance'] = 1892.7 + 100;
        }
         else if ($this->attributes['route_id'] == 55) {
            $this->attributes['distance'] = 1067.5 + 100;
        }
        else if ($this->attributes['route_id'] == 56) {
            $this->attributes['distance'] = 599.6 + 100;
        }
        else if ($this->attributes['route_id'] == 57) {
            $this->attributes['distance'] = 1343.1 + 100;
        }
        else if ($this->attributes['route_id'] == 58) {
            $this->attributes['distance'] = 575.9 + 100;
        }
        else if ($this->attributes['route_id'] == 59) {
            $this->attributes['distance'] = 869.5 + 100;
        }
        else if ($this->attributes['route_id'] == 60) {
            $this->attributes['distance'] = 687.5 + 100;
        }
         else if ($this->attributes['route_id'] == 61) {
            $this->attributes['distance'] = 1071.2 + 100;
        }
        else if ($this->attributes['route_id'] == 62) {
            $this->attributes['distance'] = 1379.7 + 100;
        }
        else if ($this->attributes['route_id'] == 63) {
            $this->attributes['distance'] = 1067.5 + 100;
        }
        else if ($this->attributes['route_id'] == 64) {
            $this->attributes['distance'] = 1645.8 + 100;
        }
        else if ($this->attributes['route_id'] == 65) {
            $this->attributes['distance'] = 567.6 + 100;
        }
        else if ($this->attributes['route_id'] == 66) {
            $this->attributes['distance'] = 1679.6 + 100;
        }
         else if ($this->attributes['route_id'] == 67) {
            $this->attributes['distance'] = 1417.7 + 100;
        }
        else if ($this->attributes['route_id'] == 68) {
            $this->attributes['distance'] = 1381.1 + 100;
        }
        else if ($this->attributes['route_id'] == 69) {
            $this->attributes['distance'] = 2133.2 + 100;
        }
        else if ($this->attributes['route_id'] == 70) {
            $this->attributes['distance'] = 2442 + 100;
        }
        else if ($this->attributes['route_id'] == 71) {
            $this->attributes['distance'] = 599.6 + 100;
        }
        else if ($this->attributes['route_id'] == 72) {
            $this->attributes['distance'] = 1645.8 + 100;
        }
        else if ($this->attributes['route_id'] == 73) {
            $this->attributes['distance'] = 325.1 + 100;
        }
        else if ($this->attributes['route_id'] == 74) {
            $this->attributes['distance'] = 325.1 + 100;
        }
        else {
            $this->attributes['distance'] = 0.00;
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTruckAttachmentStatusIdAttribute($input)
    {
        $this->attributes['truck_attachment_status_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    /*public function setMachineryAttachmentTypeIdAttribute($input)
    {
        $this->attributes['machinery_attachment_type_id'] = $input ? $input : null;
    }*/

    /**
     * Set to null if empty
     * @param $input
     */
    public function setSizeIdAttribute($input)
    {
        $this->attributes['size_id'] = $input ? $input : null;
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
    public function setAvgInvestmentAttribute($input)
    {
        $this->attributes['avg_investment'] = ($this->purchase_price+$this->salvage_value)/2;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setDepreciationAttribute($input)
    {
        if ($this->attributes['attachment_type'] == 'tri axle' || $this->attributes['attachment_type'] == 'Link') {
             $lifePeriodKm = 700000;
        } 
        else {
             $lifePeriodKm = 300000;
        }

        $Loaded = (($this->attributes['purchase_price'] - $this->attributes['salvage_value'])/$lifePeriodKm)*($this->attributes['distance']);
        $Empty = $Loaded*.62;
        
        if ($this->attributes['load_status'] == 'Loaded') {
            $this->attributes['depreciation'] = $Loaded;
        } 
        else {
            $this->attributes['depreciation'] = $Empty;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setInsuranceAttribute($input)
    {
        if ($this->attributes['attachment_type'] == 'tri axle' && $this->attributes['size_id'] == 17) {
             $kmPerAnnum = 700000;
        }
        else if ($this->attributes['attachment_type'] == 'Link' && $this->attributes['size_id'] == 18) {
             $kmPerAnnum = 700000;
        }
        else if ($this->attributes['attachment_type'] == 'Rigid' && ($this->attributes['size_id'] == 1 || $this->attributes['size_id'] == 2 || $this->attributes['size_id'] == 3 || $this->attributes['size_id'] == 4 || $this->attributes['size_id'] == 5)) {
             $kmPerAnnum = 35000;
        } 
        else if ($this->attributes['attachment_type'] == 'Rigid' && ($this->attributes['size_id'] == 6 || $this->attributes['size_id'] == 7 || $this->attributes['size_id'] == 8)) {
            $kmPerAnnum = 70000;
       } 
        else {
             $kmPerAnnum = 700000;
        }

        $this->attributes['insurance'] = ((.10*$this->attributes['avg_investment'])/$kmPerAnnum)*$this->attributes['distance'];
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setLicenseAttribute($input)
    {
        //$this->attributes['license'] = $input ? $input : null;

        //Calculating Actual km per Annum
        if ($this->attributes['attachment_type'] == 'tri axle' && $this->attributes['size_id'] == 17) {
            $kmPerAnnum = 700000;
        }
        else if ($this->attributes['attachment_type'] == 'Link' && $this->attributes['size_id'] == 18) {
                $kmPerAnnum = 700000;
        }
        else if ($this->attributes['attachment_type'] == 'Rigid' && ($this->attributes['size_id'] == 1 || $this->attributes['size_id'] == 2 || $this->attributes['size_id'] == 3 || $this->attributes['size_id'] == 4 || $this->attributes['size_id'] == 5)) {
                $kmPerAnnum = 35000;
        } 
        else if ($this->attributes['attachment_type'] == 'Rigid' && ($this->attributes['size_id'] == 6 || $this->attributes['size_id'] == 7 || $this->attributes['size_id'] == 8)) {
            $kmPerAnnum = 70000;
        } 
        else {
                $kmPerAnnum = 700000;
        }

        //Calculating Actual Cost per Annum
        if ($this->attributes['size_id'] == 1) {
            $actualCostPerAnnum = (4.29/100)*$kmPerAnnum;
        }
        else if ($this->attributes['size_id'] == 2) {
            $actualCostPerAnnum = (5.83/100)*$kmPerAnnum;
        }
        else if ($this->attributes['size_id'] == 3) {
            $actualCostPerAnnum = (6.55/100)*$kmPerAnnum;
        }
        else if ($this->attributes['size_id'] == 4) {
            $actualCostPerAnnum = (4.92/100)*$kmPerAnnum;
        }
        else if ($this->attributes['size_id'] == 5) {
            $actualCostPerAnnum = (5.87/100)*$kmPerAnnum;
        }
        else if ($this->attributes['size_id'] == 6) {
            $actualCostPerAnnum = (2.14/100)*$kmPerAnnum;
        }
        else {
            $actualCostPerAnnum = (8.59/100)*$kmPerAnnum;
        }

        $this->attributes['license'] = ($actualCostPerAnnum/$kmPerAnnum)*$this->attributes['distance'];
    }

     /**
     * Set attribute to money format
     * @param $input
     */
    public function setFuelPriceAttribute($input)
    {
        $this->attributes['fuel_price'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFuelUsageAttribute($input)
    {
        if ($this->attributes['size_id'] == 1 || $this->attributes['size_id'] == 2) {
            $this->attributes['fuel_usage'] = 15;
        } 
        else if($this->attributes['size_id'] == 3) {
            $this->attributes['fuel_usage'] = 25;
        }
        else if($this->attributes['size_id'] == 4) {
            $this->attributes['fuel_usage'] = 28;
        }
        else if($this->attributes['size_id'] == 5) {
            $this->attributes['fuel_usage'] = 30;
        }
        else if($this->attributes['size_id'] == 6) {
            $this->attributes['fuel_usage'] = 40;
        }
        else if($this->attributes['size_id'] == 7) {
            $this->attributes['fuel_usage'] = 46;
        }
        else if($this->attributes['size_id'] == 8) {
            $this->attributes['fuel_usage'] = 48;
        }
        else if($this->attributes['size_id'] == 17 || $this->attributes['size_id'] == 18) {
            $this->attributes['fuel_usage'] = 52;
        }
        else{
            $this->attributes['fuel_usage'] = 52;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setFuelAttribute($input)
    {
        $Loaded = (($this->attributes['fuel_usage']/100)*$this->attributes['distance'])*$this->attributes['fuel_price'];
        $Empty = $Loaded*.62;
        
        if ($this->attributes['load_status'] == 'Loaded') {
            $this->attributes['fuel'] = $Loaded;
        } 
        else {
            $this->attributes['fuel'] = $Empty;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFuelConsumptionAttribute($input)
    {
        $this->attributes['fuel_consumption'] = $this->attributes['fuel']/$this->attributes['fuel_price'];
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOilPriceAttribute($input)
    {
        $this->attributes['oil_price'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOilUsageAttribute($input)
    {
        if ($this->attributes['size_id'] == 1 || $this->attributes['size_id'] == 2) {
            $this->attributes['oil_usage'] = (1.5/100)*$this->attributes['fuel_usage'];
        } 
        else{
            $this->attributes['oil_usage'] = (2/100)*$this->attributes['fuel_usage'];
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOilAttribute($input)
    {
        $Loaded = (($this->attributes['oil_usage']/100)*$this->attributes['distance'])*$this->attributes['oil_price'];
        $Empty = $Loaded*.62;
        
        if ($this->attributes['load_status'] == 'Loaded') {
            $this->attributes['oil'] = $Loaded;
        } 
        else {
            $this->attributes['oil'] = $Empty;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOilConsumptionAttribute($input)
    {
        $this->attributes['oil_consumption'] = $this->attributes['oil']/$this->attributes['oil_price'];
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTyrePriceAttribute($input)
    {
        $this->attributes['tyre_price'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setNumberOfTyresAttribute($input)
    {
        $this->attributes['number_of_tyres'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTyreAttribute($input)
    {
        $tyreLifeInKm = 12500;

        $Loaded = (($this->attributes['tyre_price']*$this->attributes['number_of_tyres'])/$tyreLifeInKm)*$this->attributes['distance'];
        $Empty = $Loaded*.62;
        
        if ($this->attributes['load_status'] == 'Loaded') {
            $this->attributes['tyre'] = $Loaded;
        } 
        else {
            $this->attributes['tyre'] = $Empty;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setRepairMaintenanceAttribute($input)
    {
        //Calculating Actual km per Annum
        if ($this->attributes['attachment_type'] == 'tri axle' || $this->attributes['attachment_type'] == 'Link') {
            $lifePeriodKm = 700000;
       } 
       else {
            $lifePeriodKm = 300000;
       }

        $Loaded = ((.48*$this->attributes['purchase_price'])/$lifePeriodKm)*$this->attributes['distance'];
        $Empty = $Loaded*.62;
        
        if ($this->attributes['load_status'] == 'Loaded') {
            $this->attributes['repair_maintenance'] = $Loaded;
        } 
        else {
            $this->attributes['repair_maintenance'] = $Empty;
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setContigencyFactorAttribute($input)
    {
        $this->attributes['contigency_factor'] = .10*($this->attributes['repair_maintenance']+$this->attributes['fuel']+$this->attributes['oil']+$this->attributes['tyre']);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalCostsAttribute($input)
    {
        $this->attributes['total_costs'] = $this->attributes['depreciation']+$this->attributes['insurance']+$this->attributes['license']+$this->attributes['repair_maintenance']+$this->attributes['oil']+$this->attributes['tyre']+$this->attributes['contigency_factor'];
    }
    
    public function road_freight_number()
    {
        return $this->belongsTo(RoadFreight::class, 'road_freight_number_id')->withTrashed();
    }
    
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id')->withTrashed();
    }
    
    public function vehicle_description()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_description_id');
    }
    
    public function truck_attachment_status()
    {
        return $this->belongsTo(TruckAttachmentStatus::class, 'truck_attachment_status_id')->withTrashed();
    }
    
    public function machinery_attachment_type()
    {
        return $this->belongsTo(MachineryType::class, 'machinery_attachment_type_id')->withTrashed();
    }
    
    public function size()
    {
        return $this->belongsTo(MachinerySize::class, 'size_id')->withTrashed();
    }    
}
