<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AirFreight
 *
 * @package App
 * @property string $project_number
 * @property string $air_freight_number
 * @property string $client
 * @property string $contact_person
 * @property string $airline_or_agent_contact
 * @property string $project_manager
 * @property string $flight_number
 * @property string $route
*/
class AirFreight extends Model
{
    use SoftDeletes;

    protected $fillable = ['air_freight_number', 'flight_number', 'project_number_id', 'client_id', 'contact_person_id', 'airline_or_agent_contact_id', 'project_manager_id', 'route_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        AirFreight::observe(new \App\Observers\UserActionsObserver);
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
    public function setAirlineOrAgentContactIdAttribute($input)
    {
        $this->attributes['airline_or_agent_contact_id'] = $input ? $input : null;
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
    
    public function airline_or_agent()
    {
        return $this->belongsToMany(Vendor::class, 'air_freight_vendor')->withTrashed();
    }
    
    public function airline_or_agent_contact()
    {
        return $this->belongsTo(VendorContact::class, 'airline_or_agent_contact_id')->withTrashed();
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
        return $this->hasMany(LoadDescription::class, 'air_freight_number_id');
    }
}
