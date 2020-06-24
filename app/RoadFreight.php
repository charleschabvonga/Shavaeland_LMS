<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RoadFreight
 *
 * @package App
 * @property string $project_number
 * @property string $road_freight_number
 * @property enum $freight_contract_type
 * @property string $route
 * @property string $client
 * @property string $contact_person
 * @property string $project_manager
 * @property string $driver
 * @property string $vehicle
 * @property string $subcontractor_number
 * @property string $vendor
 * @property string $vendor_contact_person
 * @property decimal $road_freight_income
 * @property decimal $road_freight_expenses
 * @property decimal $machinery_costs
 * @property decimal $breakdown
 * @property decimal $total_expenses
 * @property decimal $net_income
*/
class RoadFreight extends Model
{
    use SoftDeletes;

    protected $fillable = ['road_freight_number', 'freight_contract_type', 'road_freight_income', 'road_freight_expenses', 'machinery_costs', 'breakdown', 'total_expenses', 'net_income', 'project_number_id', 'route_id', 'client_id', 'contact_person_id', 'project_manager_id', 'driver_id', 'vehicle_id', 'subcontractor_number_id', 'vendor_id', 'vendor_contact_person_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        RoadFreight::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_freight_contract_type = ["Shavaeland" => "Shavaeland", "Subcontractor" => "Subcontractor"];

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
    public function setVehicleIdAttribute($input)
    {
        $this->attributes['vehicle_id'] = $input ? $input : null;
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
    public function setProjectManagerIdAttribute($input)
    {
        $this->attributes['project_manager_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDriverIdAttribute($input)
    {
        $this->attributes['driver_id'] = $input ? $input : null;
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
    public function setVendorContactPersonIdAttribute($input)
    {
        $this->attributes['vendor_contact_person_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setRoadFreightIncomeAttribute($input)
    {
        $this->attributes['road_freight_income'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setRoadFreightExpensesAttribute($input)
    {
        $this->attributes['road_freight_expenses'] = $input ? $input : null;
    }

    public function getRoadFreightExpensesAttribute(){
        $expense = 0;
        foreach($this->non_machine_costs as $item){
            $expense += $item->total;
        }
        return $expense;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setMachineryCostsAttribute($input)
    {
        $this->attributes['machinery_costs'] = $input ? $input : null;
    }

    public function getMachineryCostsAttribute(){
        $expense = 0;
        foreach($this->machine_costs as $item){
            $expense += $item->total_costs;
        }
        return $expense;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setBreakdownAttribute($input)
    {
        $this->attributes['breakdown'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setTotalExpensesAttribute($input)
    {
        $this->attributes['total_expenses'] = $input ? $input : null;
    }

    public function getTotalExpensesAttribute(){
        $expense = 0;
        foreach($this->machine_costs as $item){
            $expense += $item->total_costs;
        }
        foreach($this->non_machine_costs as $item){
            $expense += $item->total;
        }
        foreach($this->fuel_costs as $item){
            $expense += $item->total;
        }
        foreach($this->job_cards as $item){
            $expense += $item->subtotal;
        }
        foreach($this->violations as $item){
            if ($item->status != 'Driver') {
                $expense += $item->amount;
            }
        }
        return $expense;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setNetIncomeAttribute($input)
    {
        $this->attributes['net_income'] = $input ? $input : null;
    }

    public function getNetIncomeAttribute(){
        $expense = $this->attributes['road_freight_income'];
        foreach($this->machine_costs as $item){
            $expense -= $item->total_costs;
        }
        foreach($this->non_machine_costs as $item){
            $expense -= $item->total;
        }
        foreach($this->fuel_costs as $item){
            $expense -= $item->total;
        }
        foreach($this->violations as $item){
            if ($item->status != 'Driver') {
                $expense -= $item->amount;
            }
        }
        foreach($this->job_cards as $item){
            $expense -= $item->subtotal;
        }
        return $expense;
    }

    public function getActualTotalFuelCostAttribute(){
        $cost = 0;
        foreach($this->fuel_costs as $item){
            $cost += $item->total;
        }
        return $cost;
    }

    public function getEstimatedTotalFuelCostAttribute(){
        $cost = 0;
        foreach($this->machine_costs as $item){
            $cost += $item->fuel;
        }
        return $cost;
    }

    public function getFuelCostBalanceAttribute(){
        $cost = 0;
        foreach($this->fuel_costs as $item){
            $cost -= $item->total;
        }
        foreach($this->machine_costs as $item){
            $cost += $item->fuel;
        }
        return $cost;
    }

    public function getActualTotalFuelQtyAttribute(){
        $qty = 0;
        foreach($this->fuel_costs as $item){
            $qty += $item->qty;
        }
        return $qty;
    }

    public function getEstimatedTotalFuelQtyAttribute(){
        $qty = 0;
        foreach($this->machine_costs as $item){
            $qty += $item->fuel_consumption;
        }
        return $qty;
    }

    public function getCitationTotalsAttribute(){
        $amount = 0;
        foreach($this->violations as $item){
            $amount += $item->amount;
        }
        return $amount; 
    }

    public function getBreakdownTotalsAttribute(){
        $amount = 0;
        foreach($this->job_cards as $item){
            $amount += $item->subtotal;
        }
        return $amount; 
    }

    public function getFuelQtyBalanceAttribute(){
        $qty = 0;
        foreach($this->fuel_costs as $item){
            $qty -= $item->qty;
        }
        foreach($this->machine_costs as $item){
            $qty += $item->fuel_consumption;
        }
        return $qty; 
    }
    
    public function project_number()
    {
        return $this->belongsTo(TimeEntry::class, 'project_number_id');
    }
    
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id')->withTrashed();
    }
    
    public function client()
    {
        return $this->belongsTo(TimeProject::class, 'client_id');
    }
    
    public function contact_person()
    {
        return $this->belongsTo(ClientContact::class, 'contact_person_id')->withTrashed();
    }
    
    public function project_manager()
    {
        return $this->belongsTo(Employee::class, 'project_manager_id')->withTrashed();
    }
    
    public function driver()
    {
        return $this->belongsTo(Employee::class, 'driver_id')->withTrashed();
    }
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    
    public function trailers()
    {
        return $this->belongsToMany(Trailer::class, 'road_freight_trailer')->withTrashed();
    }
    
    public function subcontractor_number()
    {
        return $this->belongsTo(RoadFreightSubContractor::class, 'subcontractor_number_id')->withTrashed();
    }
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id')->withTrashed();
    }
    
    public function vendor_contact_person()
    {
        return $this->belongsTo(VendorContact::class, 'vendor_contact_person_id')->withTrashed();
    }
    
    public function vendor_drivers()
    {
        return $this->belongsToMany(Driver::class, 'driver_road_freight')->withTrashed();
    }
    
    public function vendor_vehicles()
    {
        return $this->belongsToMany(VehicleSc::class, 'road_freight_vehicle_sc')->withTrashed();
    }
    
    public function non_machine_costs() {
        return $this->hasMany(NonMachineCost::class, 'road_freight_number_id');
    }

    public function fuel_costs() {
        return $this->hasMany(FuelCost::class, 'road_freight_number_id');
    }

    public function machine_costs() {
        return $this->hasMany(MachineryCost::class, 'road_freight_number_id');
    }

    public function violations() {
        return $this->hasMany(Violation::class, 'road_freight_number_id');
    }

    public function job_cards() {
        return $this->hasMany(InhouseJobCard::class, 'road_freight_number_id');
    }
}
