<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClearanceAndForwarding
 *
 * @package App
 * @property string $project_number
 * @property string $clearance_and_forwarding_number
 * @property string $border_post
 * @property string $client
 * @property string $contact_person
 * @property string $agent
 * @property string $agent_contact
 * @property string $project_manager
*/
class ClearanceAndForwarding extends Model
{
    use SoftDeletes;

    protected $fillable = ['clearance_and_forwarding_number', 'border_post', 'project_number_id', 'client_id', 'contact_person_id', 'agent_id', 'agent_contact_id', 'project_manager_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        ClearanceAndForwarding::observe(new \App\Observers\UserActionsObserver);
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
    public function setAgentIdAttribute($input)
    {
        $this->attributes['agent_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setAgentContactIdAttribute($input)
    {
        $this->attributes['agent_contact_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectManagerIdAttribute($input)
    {
        $this->attributes['project_manager_id'] = $input ? $input : null;
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
    
    public function agent()
    {
        return $this->belongsTo(Vendor::class, 'agent_id')->withTrashed();
    }
    
    public function agent_contact()
    {
        return $this->belongsTo(VendorContact::class, 'agent_contact_id')->withTrashed();
    }
    
    public function project_manager()
    {
        return $this->belongsTo(Employee::class, 'project_manager_id')->withTrashed();
    }
    
    public function invoice_items() {
        return $this->hasMany(InvoiceItem::class, 'clearance_and_forwarding_number_id');
    }
}
