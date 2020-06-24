<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SeaFreight
 *
 * @package App
 * @property string $project_number
 * @property string $sea_freight_number
 * @property string $client
 * @property string $contact_person
 * @property string $shipper_or_agent_contact
 * @property string $project_manager
 * @property string $voyage_number
 * @property string $route
*/
class SeaFreight extends Model
{
    use SoftDeletes;

    protected $fillable = ['sea_freight_number', 'voyage_number', 'project_number_id', 'client_id', 'contact_person_id', 'shipper_or_agent_contact_id', 'project_manager_id', 'route_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        SeaFreight::observe(new \App\Observers\UserActionsObserver);
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
    public function setShipperOrAgentContactIdAttribute($input)
    {
        $this->attributes['shipper_or_agent_contact_id'] = $input ? $input : null;
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
    public function setRouteIdAttribute($input)
    {
        $this->attributes['route_id'] = $input ? $input : null;
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
    
    public function shipper__or_agent()
    {
        return $this->belongsToMany(Vendor::class, 'sea_freight_vendor')->withTrashed();
    }
    
    public function shipper_or_agent_contact()
    {
        return $this->belongsTo(VendorContact::class, 'shipper_or_agent_contact_id')->withTrashed();
    }
    
    public function project_manager()
    {
        return $this->belongsTo(Employee::class, 'project_manager_id')->withTrashed();
    }
    
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id')->withTrashed();
    }
    
    public function load_descriptions() {
        return $this->hasMany(LoadDescription::class, 'sea_freight_number_id');
    }
}
